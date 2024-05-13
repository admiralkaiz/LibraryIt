<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts', [
            'title' => 'LibraryIt | Posts',
            'list' => DB::table('posts')->paginate(1),
            'admin_mode' => Auth::user()->is_admin==1,
            'role' => (Auth::user()->is_admin==1)? 'admin' : 'user'
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
        $post->user_id = Auth::user()->id;
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

    public function show(string $id) {
        $postingan = Post::find($id);
        return view('showpost', [
            'title' => "LibraryIt | $postingan->title",
            'admin_mode' => Auth::user()->is_admin == 1,
            'role' => (Auth::user()->is_admin==1)?'admin':'user',
            'data' => $postingan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect('/user/posts');
    }
}
