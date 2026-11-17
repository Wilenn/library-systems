@extends('layouts.app')

@section('content')

    <h2>Tambah Peminjaman</h2>

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 12px;">
            <label for="member_id">Anggota</label><br>
            <select name="member_id" id="member_id">
                <option value="">Pilih anggota</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <p style="color: red; margin: 4px 0;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 12px;">
            <label for="book_id">Buku</label><br>
            <select name="book_id" id="book_id">
                <option value="">Pilih buku</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" @selected(old('book_id') == $book->id)>
                        {{ $book->title }} (stok: {{ $book->stock }})
                    </option>
                @endforeach
            </select>
            @error('book_id')
                <p style="color: red; margin: 4px 0;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 12px;">
            <label for="quantity">Jumlah</label><br>
            <input type="text" id="quantity" name="quantity" value="{{ old('quantity') }}">
            @error('quantity')
                <p style="color: red; margin: 4px 0;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('borrowings.index') }}">Batal</a>
    </form>

@endsection