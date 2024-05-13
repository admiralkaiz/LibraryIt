<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateRequest = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
        if ($validateRequest->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Post create failed!",
                'errors' => $validateRequest->errors()
            ], 400);
        }
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->description = $request->description;

        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('posts'), $imageName);
            $post->image = $imageName;
        }

        $post->save();
        return response()->json([
            'status' => true,
            'message' => 'Successfully posted!',
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        
        if ($post) {
            return response()->json([
                'status' => true,
                'message' => 'Found the post!',
                'data' => $post,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'error' => 'Resource not found!',
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateRequest = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
        if ($validateRequest->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Post edit failed!",
                'errors' => $validateRequest->errors()
            ], 400);
        }

        $post = Post::find($id);
        if ($post) {
            $post->title = $request->title;
            $post->description = $request->description;
            if (isset($request->image)) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('posts'), $imageName);
                $post->image = $imageName;
            }

            $post->save();
            return response()->json([
                'status' => true,
                'message' => 'Successfully edit post!',
                'data' => $post
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Post not found!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json([
                'status' => true,
                'message' => 'Succesfully deleted!',
                'data' => $post
            ], 204);
        }
        return response()->json([
            'status' => false,
            'message' => 'Post not found!'
        ], 404);
    }
}
