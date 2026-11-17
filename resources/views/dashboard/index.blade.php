@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <p>Selamat datang di Library System.</p>

    <p>Aplikasi sederhana untuk mengelola informasi perpustakaan.</p>

    <h3>Data Perpustakaan</h3>

    <ul>
        <li>Jumlah Buku: {{ $jumlahBuku }}</li>
        <li>Jumlah Member: {{ $jumlahMember }}</li>
        <li>Jumlah Kategori: {{ $jumlahKategori }}</li>
        <li>Jumlah Transaksi Peminjaman: {{ $jumlahPeminjaman }}</li>
        <li>Transaksi Masih Berjalan: {{ $jumlahPeminjamanBerjalan }}</li>
    </ul>
@endsection
