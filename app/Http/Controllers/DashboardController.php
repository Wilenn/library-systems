<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBuku = Book::count();
        $jumlahKategori = Category::count();
        // Member belum punya tabel di database, jadi masih data statis
        // (sama dengan daftar di MemberController).
        $jumlahMember = 5;

        return view('dashboard.index', compact(
            'jumlahBuku',
            'jumlahMember',
            'jumlahKategori'
        ));
    }
}
