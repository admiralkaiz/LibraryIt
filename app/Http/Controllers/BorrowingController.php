<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
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

        if (Auth::user()->is_admin == 1)
        {
            return view('admin.allborrowings', [
                'list' => Borrowing::get()
            ]);
        }
        return view('user.allbooks', [
            'list' => Borrowing::get()
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
            'action' => '/admin/borrowings/store'
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
        $endDate = $startDate->addDays(7);
        
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
