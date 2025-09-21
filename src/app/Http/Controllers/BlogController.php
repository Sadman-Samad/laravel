<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller

{

    public function indexa()
    {
        return response()->json(Post::all());
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    // GET /api/posts/{id}
    public function show(Post $post)
    {
        return response()->json($post);
    }

   
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return response()->json($post);
    }

    
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}