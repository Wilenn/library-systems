@extends('layouts.app')

@section('content')
    <h2>Daftar Buku</h2>

    @foreach ($books as $book)
        <h3>{{ $book->title }}</h3>
        <p>Penulis: {{ $book->author }}</p>
        <p>Tahun: {{ $book->year }}</p>
        <p>Stok: {{ $book->stock }}</p>
    @endforeach
@endsection
