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
        ];

        return view('categories.index', compact('categories'));
    }
}