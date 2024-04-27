<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerForm() {
        return view('register');
    }

    public function registerUser(Request $req) {
        $req->validate([
            'name' => 'required|unique:users,name|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $new_user = new User;
        $new_user->name = $req->name;
        $new_user->email = $req->email;
        $new_user->password = Hash::make($req->password);
        $new_user->save();

        return redirect('/login');
    }
}
