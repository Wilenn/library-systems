@extends('layouts.app')

@section('content')

    <h2>Edit Buku</h2>

    @if ($errors->any())
        <div style="color: red;">
            <p>Terjadi kesalahan pada isian Anda:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 12px;">
            <label for="title">Judul Buku</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="author">Penulis</label><br>
            <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="year">Tahun Terbit</label><br>
            <input type="number" id="year" name="year" value="{{ old('year', $book->year) }}" min="1900"
                max="{{ date('Y') }}" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="stock">Stok</label><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" min="0"
                required>
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('books.index') }}">Batal</a>
    </form>

@endsection
