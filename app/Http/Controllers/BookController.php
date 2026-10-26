<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $title = 'Daftar Buku';
        $books = Book::with('category')->latest()->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => 'required|string|min:3|max:255|unique:books,title',
            'author' => 'required|string|min:3|max:255|regex:/^[\pL\s\.\,\'\-]+$/u',
            'year'   => 'required|integer|digits:4|between:1900,' . date('Y'),
            'stock'  => 'required|integer|min:0|max:1000',
            'category_id' => 'required|exists:categories,id'
        ], $this->messages());

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'  => 'required|string|min:3|max:255|unique:books,title,' . $book->id,
            'author' => 'required|string|min:3|max:255|regex:/^[\pL\s\.\,\'\-]+$/u',
            'year'   => 'required|integer|digits:4|between:1900,' . date('Y'),
            'stock'  => 'required|integer|min:0|max:1000',
            'category_id' => 'required|exists:categories,id'
        ], $this->messages());

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }

    // Pesan error dalam Bahasa Indonesia
    private function messages(): array
    {
        return [
            'title.required'  => 'Judul buku wajib diisi.',
            'title.min'       => 'Judul buku minimal 3 karakter.',
            'title.unique'    => 'Judul buku ini sudah terdaftar.',
            'author.required' => 'Nama penulis wajib diisi.',
            'author.min'      => 'Nama penulis minimal 3 karakter.',
            'author.regex'    => 'Nama penulis hanya boleh berisi huruf, spasi, titik, koma, apostrof, dan tanda hubung.',
            'year.required'   => 'Tahun terbit wajib diisi.',
            'year.integer'    => 'Tahun terbit harus berupa angka.',
            'year.digits'     => 'Tahun terbit harus 4 digit.',
            'year.between'    => 'Tahun terbit harus antara 1900 sampai ' . date('Y') . '.',
            'stock.required'  => 'Stok wajib diisi.',
            'stock.integer'   => 'Stok harus berupa bilangan bulat.',
            'stock.min'       => 'Stok tidak boleh negatif.',
            'stock.max'       => 'Stok maksimal 1000.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak tersedia.',
        ];
    }
}
