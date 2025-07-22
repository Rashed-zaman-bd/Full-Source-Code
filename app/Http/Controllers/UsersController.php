<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    //get all user
    public function getUsers()
    {
        $user = User::all();
        return response()->json($user);
    }

    //get single user
    public function getUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // create single user
    public function createUser(Request $request)
{
    $request->validate([
        'role' => 'nullable|string',
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'profile_image' => 'nullable|string',
        'password' => 'required|string|min:5',
    ]);

    $user = User::create([
        'role' => $request->role,
        'name' => $request->name,
        'email' => $request->email,
        'profile_image' => $request->profile_image,
        'password' => Hash::make($request->password),
    ]);

    return response()->json([
        'message' => 'Insert success',
        'data' => $user
    ]);
}

// single user updated
public function updateUser(Request $request, $id)
{
    $request->validate([
        'role' => 'nullable|string',
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,'.$id,
        'profile_image' => 'nullable|string',
    ]);
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json([
            'message'=> 'update successful',
            'data'=> $user
        ]);
}

//delete user
public function deleteUser($id)
{
        User::destroy($id);

        return response()->json([
            'message'=> 'delete successful',
            'data'=> ''
        ]);
}

}
