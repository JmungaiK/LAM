<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all user progress records from the database
        $userProgress = UserProgress::all();

        // Return the user progress records as a JSON response
        return response()->json($userProgress);
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
            'video_id' => 'required|exists:videos,video_id',
            'video_category_id' => 'required|exists:video_categories,video_category_id',
            'user_started_at' => 'required|date',
            'user_finished_at' => 'nullable|date',
            'is_video_completed' => 'required|boolean',
        ]);

        // Create a new user progress record
        $userProgress = UserProgress::create($request->all());

        // Return a JSON response indicating success
        return response()->json(['message' => 'User progress created successfully', 'user_progress' => $userProgress], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Find the user progress record by its ID
        $userProgress = UserProgress::findOrFail($id);

        // Return the user progress record as a JSON response
        return response()->json($userProgress);
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
        // Find the user progress record by its ID
        $userProgress = UserProgress::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'video_id' => 'required|exists:videos,video_id',
            'video_category_id' => 'required|exists:video_categories,video_category_id',
            'user_started_at' => 'required|date',
            'user_finished_at' => 'nullable|date',
            'is_video_completed' => 'required|boolean',
        ]);

        // Update the user progress record attributes
        $userProgress->update($request->all());

        // Return a JSON response indicating success
        return response()->json(['message' => 'User progress updated successfully', 'user_progress' => $userProgress]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Find the user progress record by its ID and delete it
        $userProgress = UserProgress::findOrFail($id);
        $userProgress->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'User progress deleted successfully']);
    }
}
