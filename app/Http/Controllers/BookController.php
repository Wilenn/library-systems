<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year'   => 'required|integer',
            'stock'  => 'required|integer|min:0',
        ]);

        Book::create($validatedData);

        return redirect()->route('books.index');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year'   => 'required|integer',
            'stock'  => 'required|integer|min:0',
        ]);

        $book->update($validatedData);

        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}   