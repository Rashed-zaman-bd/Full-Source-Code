<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmationMail;

class AuthController extends Controller
{
    public function userRegistration(Request $request)
    {
        // Validate input
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required',
            'profile_image' => 'nullable',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validation->errors(),
            ], 400);

            // Handle profile image upload


        }

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'profile_image' => $request->profile_image,
    ]);

        $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'User registered successfully',
        'data' => new UserResource($user),
        'token'=>$token
    ], 200);
    }
}
