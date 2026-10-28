<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Aman dijalankan berulang kali (firstOrCreate tidak membuat duplikat).
     */
    public function run(): void
    {
        $names = [
            'Fiksi',
            'Non-Fiksi',
            'Pendidikan',
            'Komik dan Manga',
            'Romance',
            'Fantasi dan Petualangan',
            'Pengembangan Diri',
            'Puisi dan Musik',
        ];

        foreach ($names as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
