<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all comments from the database
        $comments = Comment::all();

        // Return the comments as a JSON response
        return response()->json($comments);
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
            'user_id' => 'required|integer',
            'video_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        // Create a new comment record
        $comment = Comment::create([
            'user_id' => $request->user_id,
            'video_id' => $request->video_id,
            'content' => $request->content,
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Find the comment by its ID
        $comment = Comment::findOrFail($id);

        // Return the comment as a JSON response
        return response()->json($comment);
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
        // Find the comment by its ID
        $comment = Comment::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|integer',
            'video_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        // Update the comment attributes
        $comment->update([
            'user_id' => $request->user_id,
            'video_id' => $request->video_id,
            'content' => $request->content,
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Find the comment by its ID and delete it
        $comment = Comment::findOrFail($id);
        $comment->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
