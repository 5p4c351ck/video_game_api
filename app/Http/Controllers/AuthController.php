<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	public function register(Request $request)
	{
	     $validator = Validator::make($request->all(), [
		'name' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:users',
		'password' => 'required|string|min:8',
	     ]);

	     if ($validator->fails()) {
	         return response()->json($validator->errors(), 400);
	     }

	     $user = User::create([
	        'name' => $request->name,
	        'email' => $request->email,
	        'password' => Hash::make($request->password),
	     ]);

	     return response()->json(['token' => $user->createToken('GameManagement')->plainTextToken], 201);
	}



	public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');

            if (auth()->attempt($credentials)) {
    	        return response()->json(['token' => auth()->user()->createToken('GameManagement')->plainTextToken]);
	    }
            return response()->json(['error' => 'Unauthorized'], 401);
        }



 	public function logout()
        {
            auth()->user()->tokens->each(function ($token) {
            $token->delete();
            });

            return response()->json(['message' => 'Logged out successfully']);
    	}
}
