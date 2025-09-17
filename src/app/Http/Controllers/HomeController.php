<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $name = "Sadman";  // ডাটাবেস থেকে আনা লাগলে Model use করতে পারো
        return view('home', compact('name'));
    }
}
