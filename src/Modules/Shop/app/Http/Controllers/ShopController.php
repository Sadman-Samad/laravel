<?php

namespace Modules\Shop\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = Blog::all();
        return view('shop::index', ['shop' => $shop]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shop::create'); // just show the form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate input
        $validated = $request->validate([
            "title"   => "required|string|max:255",
            "content" => "required|string|max:255",
            "image"   => "required|string|max:255",
        ]);

        // create new Blog/Shop
        Blog::create([
            "title"   => $validated["title"],
            "content" => $validated["content"],
            "user_id" => $request->user()->id,
            "image"   => $validated["image"],
        ]);

        return redirect()->route('shop.index')->with('success', 'Shop created successfully!');
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('shop::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('shop::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
