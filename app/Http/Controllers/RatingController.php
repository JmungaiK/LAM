<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * Store a newly created rating in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'video_id' => 'required|exists:videos,id',
            'rating' => 'required|integer|between:0,5',
        ]);

        // Create a new rating record
        $rating = new Rating();
        $rating->user_id = $request->user_id;
        $rating->video_id = $request->video_id;
        $rating->rating = $request->rating;
        $rating->save();

        // Return a success response
        return response()->json(['message' => 'Rating saved successfully'], 201);
    }
    /**
     * Update the specified rating in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:0|max:5',
        ]);

        // Update the rating
        $rating->update([
            'rating' => $validatedData['rating'],
        ]);

        return response()->json([
            'message' => 'Rating updated successfully',
            'rating' => $rating,
        ]);
    }

    /**
     * Get all ratings associated with a specific user ID.
     *
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRatingsByUser($userId)
    {
        $ratings = Rating::where('user_id', $userId)->get();

        return response()->json(['ratings' => $ratings]);
    }

    /**
     * Get all ratings associated with a specific video ID.
     *
     * @param int $videoId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRatingsByVideo($videoId)
    {
        $ratings = Rating::where('video_id', $videoId)->get();

        return response()->json(['ratings' => $ratings]);
    }
}
