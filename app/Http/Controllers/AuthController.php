<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validation->errors(),
            ], 400);
        }

        // Handle profile image upload (if provided)
        $profile_image = null;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $image_name = 'profile_image_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $image_name); // Save in storage/app/public/profile_images
            $profile_image = 'storage/profile_images/' . $image_name; // Accessible path from public
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'profile_image' => $profile_image,
        ]);

        // Create Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'data' => new UserResource($user),
            'token' => $token
        ], 200);
    }


    // Login system
    public function login(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=> false,
                'message'=> 'validation error',
                'errors'=> $validation->errors()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'status'=> false,
                'message'=> 'Credentials do not match',
            ], 400);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=> true,
            'message'=> 'Login successful',
            'data'=> new UserResource($user),
            'token'=> $token
        ], 200);

    }

    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke the current access token
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

}


