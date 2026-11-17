<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BorrowingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Member $member;

    private Book $book;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->member = Member::create(['name' => 'Wisnu']);
        $this->book = Book::create([
            'title' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'year' => 2005,
            'stock' => 5,
        ]);
    }

    private function borrow(int $quantity)
    {
        return $this->actingAs($this->user)->post(route('borrowings.store'), [
            'member_id' => $this->member->id,
            'book_id' => $this->book->id,
            'quantity' => $quantity,
        ]);
    }

    public function test_borrowing_records_transaction_and_reduces_stock(): void
    {
        $this->borrow(2)->assertRedirect(route('borrowings.index'));

        $this->assertDatabaseHas('borrowings', [
            'user_id' => $this->user->id,
            'member_id' => $this->member->id,
            'status' => 'borrowed',
        ]);
        $this->assertDatabaseHas('borrowing_details', ['book_id' => $this->book->id, 'quantity' => 2]);
        $this->assertSame(3, $this->book->fresh()->stock);
    }

    public function test_borrowing_is_rejected_when_stock_is_insufficient(): void
    {
        $this->borrow(6)->assertSessionHasErrors('quantity');

        $this->assertDatabaseCount('borrowings', 0);
        $this->assertSame(5, $this->book->fresh()->stock);
    }

    public function test_borrowing_requires_member_and_book(): void
    {
        $this->actingAs($this->user)
            ->post(route('borrowings.store'), ['quantity' => 1])
            ->assertSessionHasErrors(['member_id', 'book_id']);

        $this->assertDatabaseCount('borrowings', 0);
    }

    public function test_returning_book_restores_stock(): void
    {
        $this->borrow(2);
        $borrowing = Borrowing::firstOrFail();

        $this->actingAs($this->user)
            ->post(route('borrowings.return', $borrowing))
            ->assertRedirect(route('borrowings.index'));

        $this->assertSame('returned', $borrowing->fresh()->status);
        $this->assertSame(5, $this->book->fresh()->stock);
    }

    public function test_guest_cannot_borrow(): void
    {
        $this->post(route('borrowings.store'), [])->assertRedirect(route('login'));
    }
}