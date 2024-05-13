<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'description' => 'required',
        ]);

        $rev = new Review;
        $rev->user_id = Auth::user()->id;
        $rev->book_id = $req->book_id;
        $rev->description = $req->description;

        $rev->save();

        return redirect()->back();
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
