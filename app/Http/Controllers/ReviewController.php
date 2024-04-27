<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth::user()->is_admin == 1)
        // {
        //     return view('admin.makereview', [
        //         'title' => 'Make A Review',
        //         'method' => 'POST',
        //         'action' => '/admin/reviews/add'
        //     ]);
        // }
        // return view('user.makereview', [
        //     'title' => 'Make A Review',
        //     'method' => 'POST',
        //     'action' => '/user/reviews/add'
        // ]);
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

        $rev = new Review;
        $rev->user_id = Auth::user()->id;
        $rev->book_id = $req->book_id;
        $rev->title = $req->title;
        $rev->description = $req->description;

        if (isset($req->image)) {
            $imageName = time() . '.' . $req->image->extension();
            $req->image->move(public_path('reviews'), $imageName);
            $rev->image = $imageName;
        }

        $rev->save();

        return redirect()->back();
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
        Review::destroy($id);
        return redirect()->back();
    }
}
