<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1)
        {
            return view('admin.allposts', [
                'list' => Post::get()
            ]);
        }
        return view('user.allposts', [
            'list' => Post::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->is_admin == 1)
        {
            return view('admin.makepost', [
                'title' => 'Make A Post',
                'method' => 'POST',
                'action' => '/admin/posts/add'
            ]);
        }
        return view('user.makepost', [
            'title' => 'Make A Post',
            'method' => 'POST',
            'action' => '/user/posts/add'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $post = new Post;
        $post->title = $req->title;
        $post->description = $req->description;

        if (isset($req->image)) {
            $imageName = time() . '.' . $req->image->extension();
            $req->image->move(public_path('posts'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        if (Auth::user()->is_admin == 1) {
            return redirect('/admin/posts');
        }
        return redirect('/user/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Post::find($id)->user()->get()->id == Auth::user()->id) {
            Post::destroy($id);
        }
        if (Auth::user()->is_admin == 1) {
            return redirect('/admin/posts');
        }
        return redirect('/user/posts');
    }
}
