<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1)
        {
            return view('admin.allbooks', [
                'list' => Book::get()
            ]);
        }
        return view('user.allbooks', [
            'list' => Book::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bookform', [
            'title' => 'Input New Book',
            'method' => 'POST',
            'action' => '/admin/books/store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'isbn' => 'required',
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'synopsis' => 'required'
        ]);
        $book = new Book;
        $book->isbn = $req->isbn;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->publisher = $req->publisher;
        $book->year = $req->year;
        $book->synopsis = $req->synopsis;
        if (isset($req->image)) {
            $imageName = time() . '.' . $req->image->extension();
            $req->image->move(public_path('books'), $imageName);
            $book->image = $imageName;
        }
        $book->save();
        return redirect('/admin/books')->with('msg', 'Successfully Added A Book!');
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
        return view('admin.bookform', [
            'title' => 'Edit Existing Book',
            'method' => 'PUT',
            'action' => "/admin/$id/books/update",
            'data' => Book::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $req->validate([
            'isbn' => 'required',
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'synopsis' => 'required'
        ]);

        $book = Book::find($id);
        $book->isbn = $req->isbn;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->publisher = $req->publisher;
        $book->year = $req->year;
        $book->synopsis = $req->synopsis;

        if (isset($req->image)) {
            $imageName = time() . '.' . $req->image->extension();
            $req->image->move(public_path('books'), $imageName);
            $book->image = $imageName;
        }

        $book->save();

        return redirect('/admin/books')->with('msg', 'Successfully Updated A Book!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::destroy($id);
        return redirect('/admin/books')->with('msg', 'Successfully Deleted A Book!');
    }
}
