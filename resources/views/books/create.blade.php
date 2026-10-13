@extends('layouts.app')

@section('content')

    <h2>Tambah Buku</h2>

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

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 12px;">
            <label for="title">Judul Buku</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Pemrograman PHP"
                required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="author">Penulis</label><br>
            <input type="text" id="author" name="author" value="{{ old('author') }}" placeholder="Contoh: Tere Liye"
                required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="year">Tahun Terbit</label><br>
            <input type="number" id="year" name="year" value="{{ old('year') }}" placeholder="Contoh: 2024"
                min="1900" max="{{ date('Y') }}" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="stock">Stok</label><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" placeholder="Contoh: 5"
                min="0" required>
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('books.index') }}">Batal</a>
    </form>

@endsection
