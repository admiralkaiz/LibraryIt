<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        foreach (Borrowing::get() as $b) {
            if (Carbon::now()->gt(Carbon::parse($b->borrow_date))) {
                $b->is_late = 1;
            }
        }

        return view('borrowinglist', [
            'borrowings' => Borrowing::get(),
            'title' => 'LibraryIt | Borrowing List',
            'admin_mode' => Auth::user()->is_admin==1,
            'role' => (Auth::user()->is_admin==1)? 'admin' : 'user'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.borrowingform', [
            'title' => 'Input New Borrowing',
            'method' => 'POST',
            'action' => '/admin/borrowings/store',
            'userslist' => User::get(),
            'bookslist' => Book::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        $borrowing = new Borrowing;

        $borrowing->user_id = $req->user_id;
        $borrowing->book_id = $req->book_id;
        
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(7);
        
        $borrowing->borrow_date = $startDate;
        $borrowing->return_date = $endDate;
        $borrowing->is_returned = 0;
        $borrowing->is_late = 0;

        $borrowing->save();

        return redirect('/admin/borrowings')->with('msg', 'Borrow Successful!');
    }

    public function setAsReturned(string $id) {
        $borrowing = Borrowing::find($id);
        $borrowing->is_returned = 1;
        $borrowing->save();
        return redirect('/admin/borrowings');
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
        //
    }
}
