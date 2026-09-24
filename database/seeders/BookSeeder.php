<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Pemrograman PHP',
            'author' => 'Andi',
            'year' => 2024,
            'stock' => 5,
        ]);


    Book::create([
        'title' => 'Bumi',
        'author' => 'Tere Liye',
        'year' => 2014,
        'stock' => 4,
    ]);
    Book::create([
        'title' => 'Pulang',
        'author' => 'Tere Liye',
        'year' => 2015,
        'stock' => 6,
    ]);

    Book::create([
        'title' => 'Perahu Kertas',
        'author' => 'Dee Lestari',
        'year' => 2009,
        'stock' => 3,
    ]);

    Book::create([
        'title' => 'Dilan: Dia adalah Dilanku Tahun 1990',
        'author' => 'Pidi Baiq',
        'year' => 2014,
        'stock' => 7,
    ]);
    }
}
