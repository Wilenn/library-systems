<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = [
            'Fiksi',
            'Non-Fiksi',
            'Pendidikan',
            'komik dan Manga',
            'romance',
            'fantasi dan petualangan',
            'pengembangan diri',
            'puisi dan musik'
        ];

        return view('categories.index', compact('categories'));
    }
}