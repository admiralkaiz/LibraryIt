<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthAPI extends Controller
{
    private $registerValidator = [
        'name' => 'required|unique:users,name|min:4',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ];

    private $loginValidator = [
        'email' => 'required',
        'password' => 'required',
    ];

    public function registerUser(Request $request) {
        $validateRequest = Validator::make($request->all(), $this->registerValidator);

        if ($validateRequest->fails()) {
            return response()->json([
                'status' => false,
                'message' => "User create failed!",
                'error' => $validateRequest->errors()
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => "Successfully added user!",
            'token' => $user->createToken('token')->plainTextToken
        ], 200);
    }

    public function loginUser(Request $request) {
        $validateRequest = Validator::make($request->all(), $this->loginValidator);

        if ($validateRequest->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Invalid login data!",
                'error' => $validateRequest->errors()
            ], 401);
        }

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => (Auth::user()->is_admin == 1) ? "Admin Login Successful!" : "Login Successful!",
                'token' => $user->createToken('token')->plainTextToken
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => "Matching email and password not found!",
        ], 401);
    }
}
