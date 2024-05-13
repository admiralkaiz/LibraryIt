<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookAPI extends Controller
{
    private $bookValidator = [
        'isbn' => 'required',
        'title' => 'required',
        'author' => 'required',
        'publisher' => 'required',
        'year' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg',
        'synopsis' => 'required'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_admin==1) {
            $validateRequest = Validator::make($request->all(), $this->bookValidator);
            if ($validateRequest->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Book create failed!",
                    'errors' => $validateRequest->errors()
                ], 400);
            }

            $book = new Book;
            $book->isbn = $request->isbn;
            $book->title = $request->title;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->year = $request->year;
            $book->synopsis = $request->synopsis;
            if (isset($request->image)) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('books'), $imageName);
                $book->image = $imageName;
            }
            $book->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Successfully added a book!',
                'data' => $book
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unauthorized access!'
        ], 403);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        
        if ($book) {
            return response()->json([
                'status' => true,
                'message' => 'Found the book!',
                'data' => [
                    'book' => $book,
                    'reviews' => $book->reviews()->get()
                ],
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->is_admin==1) {
            $validateRequest = Validator::make($request->all(), $this->bookValidator);
            if ($validateRequest->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Book create failed!",
                    'errors' => $validateRequest->errors()
                ], 400);
            }
    
            $book = Book::find($id);
            $book->isbn = $request->isbn;
            $book->title = $request->title;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->year = $request->year;
            $book->synopsis = $request->synopsis;
    
            if (isset($request->image)) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('books'), $imageName);
                $book->image = $imageName;
            }
    
            $book->save();
            return response()->json([
                'status' => true,
                'message' => "Succesfully edited a book!",
                'data' => $book
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized access!'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->is_admin==1) {
            $book = Book::find($id);

            if ($book) {
                $book->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Succesfully deleted!',
                    'data' => $book
                ], 204);
            }
            return response()->json([
                'status' => false,
                'message' => 'Book not found!'
            ], 404);
        }
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized access!'
        ], 403);
    }
}
