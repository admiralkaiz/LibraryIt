<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Review::get(), 200);
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
            'book_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);
        if ($validateRequest->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Review create failed!",
                'errors' => $validateRequest->errors()
            ], 400);
        }

        $rev = new Review;
        $rev->user_id = Auth::user()->id;
        $rev->book_id = $request->book_id;
        $rev->title = $request->title;
        $rev->description = $request->description;

        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('reviews'), $imageName);
            $rev->image = $imageName;
        }

        $rev->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully posted review!',
            'data' => $rev
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rev = Review::find($id);
        
        if ($rev) {
            return response()->json([
                'status' => true,
                'message' => 'Found the review!',
                'data' => $rev,
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
                'message' => "Review create failed!",
                'errors' => $validateRequest->errors()
            ], 400);
        }

        $rev = Review::find($id);
        if ($rev) {
            $rev->title = $request->title;
            $rev->description = $request->description;

            if (isset($request->image)) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('reviews'), $imageName);
                $rev->image = $imageName;
            }

            $rev->save();

            return response()->json([
                'status' => true,
                'message' => 'Successfully edited review!',
                'data' => $rev
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Book not found!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rev = Review::find($id);
        if ($rev) {
            $rev->delete();
            return response()->json([
                'status' => true,
                'message' => 'Succesfully deleted!',
                'data' => $rev
            ], 204);
        }
        return response()->json([
            'status' => false,
            'message' => 'Review not found!'
        ], 404);
    }
}
