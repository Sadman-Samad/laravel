<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function construct()
    {
        $this->middleware('auth'); 
    }

    public function index(Request $request)
    {
        $name = "Sadman";  
        $user = $request->user();
        return view('home', compact('name', 'user'));
    }
};
