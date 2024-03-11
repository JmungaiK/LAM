<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();

        // Return the users as a JSON response
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|lowercase|email|max:255|unique:users,user_email',
            'user_password' => 'required|string|min:8',
        ]);

        // Create a new user record
        $user = User::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => bcrypt($request->user_password),
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Return the user as a JSON response
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|lowercase|email|max:255|unique:users,user_email,' . $user->id,
            'user_password' => 'required|string|min:8',
        ]);

        // Update the user record
        $user->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => bcrypt($request->user_password),
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Find the user by ID and delete it
        $user = User::findOrFail($id);
        $user->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'User deleted successfully']);
    }
}
