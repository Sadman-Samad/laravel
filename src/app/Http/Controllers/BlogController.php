<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // GET /api/blogs
    public function index()
    {
        $blogs = Blog::with(['user', 'categories'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Blogs retrieved successfully',
            'data' => $blogs
        ], 200);
    }

    // POST /api/blogs
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'categories' => 'nullable|array',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => 1, 
        ]);

        if ($request->has('categories')) {
            $blog->categories()->attach($request->categories);
        }

        return response()->json($blog, 201);
    }



    // GET /api/blogs/{id}
    public function show(Blog $blog)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Blog retrieved successfully',
            'data' => $blog->load(['user', 'categories'])
        ], 200);
    }

    // PUT /api/blogs/{id}
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'   => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $blog->update($request->only(['title', 'content', 'image']));

        if ($request->has('categories')) {
            $blog->categories()->sync($request->categories);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Blog updated successfully',
            'data' => $blog->load(['user', 'categories'])
        ], 200);
    }

    // DELETE /api/blogs/{id}
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Blog deleted successfully',
            'data' => null
        ], 200);
    }
}
