<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $data = [
            'nama' => 'Kyla Nisrina Anggrahini',
            'kelas' => 'A',
            'npm' => '2267051002'
        ];

        return view('profile', $data);
        }
}
