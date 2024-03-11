<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('moderator.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all administrators from the database
        $administrators = Administrator::all();

        // Return the administrators as a JSON response
        return response()->json($administrators);
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
            'user_id' => 'required|exists:users,user_id',
            // Add any other validation rules as needed
        ]);

        // Create a new administrator record
        $administrator = Administrator::create($request->all());

        // Return a JSON response indicating success
        return response()->json(['message' => 'Administrator created successfully', 'administrator' => $administrator], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Find the administrator by its ID
        $administrator = Administrator::findOrFail($id);

        // Return the administrator as a JSON response
        return response()->json($administrator);
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
        // Find the moderator by its ID
        $administrator = Administrator::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            // Add any other validation rules as needed
        ]);

        // Update the administrator attributes
        $administrator->update($request->all());

        // Return a JSON response indicating success
        return response()->json(['message' => 'Administrator updated successfully', 'administrator' => $administrator]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Find the administrator by its ID and delete it
        $administrator = Administrator::findOrFail($id);
        $administrator->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Administrator deleted successfully']);
    }
}
