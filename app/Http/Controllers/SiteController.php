<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    /**
     * Fungsi autentikasi yang dapat membedakan user biasa maupun admin,
     * dan mencocokkan data email dan password saat login
     */
    public function auth(Request $req) {
        if (Auth::attempt(['email'=>$req->email, 'password'=>$req->password])) {
            if (Auth::user()->is_admin == 1)
                return redirect('/admin/books');
            return redirect('/user/books');
        }
        return redirect('/login')->with('msg', 'Email atau password salah!');
    }
}
