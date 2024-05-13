<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Fungsi untuk menampilkan seluruh data peminjaman buku
         * Admin dapat melihat semua record peminjaman buku dan
         * user hanya dapat melihat peminjaman buku yang dilakukan
         * user yang bersangkutan yang masih berlangsung (atau belum dikembalikan)
        */

        foreach (Borrowing::get() as $b) {
            if (Carbon::now()->gt(Carbon::parse($b->borrow_date))) {
                $b->is_late = 1;
                $b->save();
            }
        }

        return view('borrowinglist', [
            'borrowings' => Borrowing::get(),
            // 'borrowings' => DB::table('borrowings')->paginate(20),
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
        /**
         * Fungsi untuk menampilkan form input data peminjaman buku
         */
        return view('borrowingform', [
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
        /**
         * Fungsi ini berfungsi untuk menyimpan data baru peminjaman buku 
         * ke dalam database. Fungsi ini hanya bisa diakses oleh admin.
         */

        // Validasi request
        $req->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        $borrowing = new Borrowing;

        $borrowing->user_id = $req->user_id;
        $borrowing->book_id = $req->book_id;
        
        // Menambahkan tanggal pada data baru peminjaman buku
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(7);
        $borrowing->borrow_date = $startDate;
        $borrowing->return_date = $endDate;

        // Default status pengembalian dan keterlambatan adalah 0(false)
        $borrowing->is_returned = 0;
        $borrowing->is_late = 0;

        $borrowing->save();

        return redirect('/admin/borrowings')->with('msg', 'Borrow Successful!');
    }

    public function setAsReturned(string $id) {
        /**
         * Fungsi ini berfungsi untuk menandakan status pengembalian sebuah peminjaman buku
         * sebagai sudah dikembalikan
         * 
         */
        $borrowing = Borrowing::find($id);
        $borrowing->is_returned = 1;
        $borrowing->save();
        return redirect('/admin/borrowings');
    }
}
