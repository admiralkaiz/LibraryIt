<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BorrowingAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Borrowing::get(), 200);
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
        if (Auth::user()->is_admin==1) {
            $validateRequest = Validator::make($request->all(), [
                'user_id' => 'required',
                'book_id' => 'required',
            ]);

            if ($validateRequest->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Borrowing create failed!",
                    'errors' => $validateRequest->errors()
                ], 400);
            }

            $borrowing = new Borrowing;

            $borrowing->user_id = $request->user_id;
            $borrowing->book_id = $request->book_id;
            
            // Menambahkan tanggal pada data baru peminjaman buku
            $startDate = Carbon::now();
            $endDate = Carbon::now()->addDays(7);
            $borrowing->borrow_date = $startDate;
            $borrowing->return_date = $endDate;

            // Default status pengembalian dan keterlambatan adalah 0(false)
            $borrowing->is_returned = 0;
            $borrowing->is_late = 0;

            $borrowing->save();

            return response()->json([
                'status' => true,
                'message' => 'Successfully input borrowing!',
                'data' => $borrowing
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
        $borrowing = Borrowing::find($id);
        
        if ($borrowing) {
            return response()->json([
                'status' => true,
                'message' => 'Found!',
                'data' => $borrowing,
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
        if (Auth::user()->is_admin==1) {
            $validateRequest = Validator::make($request->all(), [
                'user_id' => 'nullable',
                'book_id' => 'nullable',
                'borrow_date' => 'nullable',
                'return_date' => 'nullable',
                'is_returned' => 'nullable',
                'is_late' => 'nullable',
            ]);

            if ($validateRequest->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Borrowing update failed!",
                    'errors' => $validateRequest->errors()
                ], 400);
            }

            $borrowing = Borrowing::find($id);
            if ($borrowing) {
                if ($request->user_id) $borrowing->user_id = $request->user_id;
                if ($request->book_id) $borrowing->book_id = $request->book_id;
                if ($request->borrow_date) $borrowing->borrow_date = $request->borrow_date;
                if ($request->return_date) $borrowing->return_date = $request->return_date;
                if ($request->is_returned) $borrowing->is_returned = $request->is_returned;
                if ($request->is_late) $borrowing->is_late = $request->is_late;

                $borrowing->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Successfully updated borrowing!',
                    'data' => $borrowing
                ], 201);
            }
            return response()->json([
                'status' => false,
                'message' => 'Borrowing not found!'
            ], 404);
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
            $borrowing = Borrowing::find($id);

            if ($borrowing) {
                $borrowing->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Succesfully deleted!',
                    'data' => $borrowing
                ], 204);
            }
            return response()->json([
                'status' => false,
                'message' => 'Borrowing not found!'
            ], 404);
        }
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized access!'
        ], 403);
    }
}
