<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->latest('id')->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('books.create', compact('categories'));
    }

    public function store(BookRequest $request)
    {
        Book::create($request->validated());

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        $book->load('category');

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        Gate::authorize('delete', $book);

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}
