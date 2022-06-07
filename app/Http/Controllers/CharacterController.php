<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function show(int $id)
    {
        return view('character', ['id' => $id]);
    }
}
