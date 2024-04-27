<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Menampilkan data seluruh buku yang ada
         */
        return view('allbooks', [
            'title' => 'LibraryIt | Books',
            'list' => Book::get(),
            'admin_mode' => Auth::user()->is_admin == 1,
            'role' => (Auth::user()->is_admin==1)?'admin':'user'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * Menampilkan form peminjaman buku
         * Fungsi ini hanya dapat diakses oleh admin
         * 
         */
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
        /**
         * Menyimpan buku ke dalam database
         */
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
        return redirect('/admin/books');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /**
         * Menampilkan informasi salah satu buku
         */
        $book = Book::find($id);

        if ($book) {
            return view('bookinfo', [
                'title' => "LibraryIt | $book->title",
                'admin_mode' => Auth::user()->is_admin == 1,
                'role' => (Auth::user()->is_admin==1)?'admin':'user',
                'data' => $book,
                'reviews' => $book->reviews()->get()
            ]);
        }
        return view('bookinfo', [
            'title' => "LibraryIt | Book Not Found",
            'err_msg' => 'Sorry... Book is not found!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /**
         * Mengedit data buku
         */
        return view('admin.bookform', [
            'title' => 'Edit Existing Book',
            'method' => 'PUT',
            'action' => "/admin/books/$id/update",
            'data' => Book::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        /**
         * Memperbarui data buku yang sudah diedit
         */
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

        return redirect('/admin/books');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /**
         * Menghapus buku dari database
         */
        $book = Book::find($id);
        foreach ($book->reviews()->get() as $r) {
            Review::destroy($r->id);
        }
        Book::destroy($id);
        return redirect('/admin/books')->with('msg', 'Successfully Deleted A Book!');
    }
}
