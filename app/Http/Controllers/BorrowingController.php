<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])
            ->latest()
            ->latest('id')
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get(['id', 'name']);
        $books = Book::orderBy('title')->get(['id', 'title', 'stock']);

        return view('borrowings.create', compact('members', 'books'));
    }

    // Ketentuan 3, 4, 6: simpan transaksi, kurangi stok, validasi input.
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id'   => 'required|exists:books,id',
            'quantity'  => 'required|integer|min:1',
        ], [
            'member_id.required' => 'Anggota wajib dipilih.',
            'member_id.exists'   => 'Anggota yang dipilih tidak tersedia.',
            'book_id.required'   => 'Buku wajib dipilih.',
            'book_id.exists'     => 'Buku yang dipilih tidak tersedia.',
            'quantity.required'  => 'Jumlah wajib diisi.',
            'quantity.integer'   => 'Jumlah harus berupa bilangan bulat.',
            'quantity.min'       => 'Jumlah minimal 1.',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < $request->quantity) {
            return back()
                ->withErrors([
                    'quantity' => 'Stok buku tidak mencukupi.',
                ])
                ->withInput();
        }

        $borrowing = Borrowing::create([
            'user_id' => Auth::id(),
            'member_id' => $request->member_id,
            'borrowing_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
            'status' => 'borrowed',
        ]);

        $borrowing->details()->create([
            'book_id' => $book->id,
            'quantity' => $request->quantity,
        ]);

        $book->decrement('stock', $request->quantity);

        return redirect()->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    // Ketentuan 5: ubah status, isi tanggal kembali, tambah stok.
    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'borrowed') {
            return back()->withErrors([
                'borrowing' => 'Transaksi ini sudah dikembalikan.',
            ]);
        }

        $borrowing->update([
            'return_date' => now()->toDateString(),
            'status' => 'returned',
        ]);

        foreach ($borrowing->details as $detail) {
            $detail->book->increment('stock', $detail->quantity);
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}