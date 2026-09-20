<?php

namespace App\Http\Controllers;

class MemberController extends Controller
{
    public function index()
    {
        $members = [
            'Wisnu',
            'bilal',
            'Yuda',
            'Dimas',
            'Zorif'
        ];

        return view('members.index', compact('members'));
    }
}