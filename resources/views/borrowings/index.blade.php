@extends('layouts.app')

@section('content')

    <h2>Daftar Peminjaman</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 12px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <a href="{{ route('borrowings.create') }}">+ Tambah Peminjaman</a>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Petugas</th>
                <th>Buku (jumlah)</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrowing->member->name }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>
                        @foreach ($borrowing->details as $detail)
                            {{ $detail->book->title }} ({{ $detail->quantity }})<br>
                        @endforeach
                    </td>
                    <td>{{ $borrowing->borrowing_date }}</td>
                    <td>{{ $borrowing->due_date }}</td>
                    <td>{{ $borrowing->return_date ?? '-' }}</td>
                    <td>{{ $borrowing->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</td>
                    <td>
                        @if ($borrowing->status === 'borrowed')
                            <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" onclick="return confirm('Proses pengembalian buku ini?')">Kembalikan</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection