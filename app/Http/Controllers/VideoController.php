<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('moderator.admin')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all videos from the database
        $videos = Video::all();

        // Return the videos as a JSON response
        return response()->json($videos);
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
            'video_title' => 'required|string|max:255',
            'video_description' => 'nullable|string',
            'video_thumbnail_url' => 'nullable|string|max:255',
            'youtube_video_url' => 'required|string|max:255',
            'video_duration' => 'nullable|integer',
        ]);

        // Create a new video record
        $video = Video::create([
            'video_title' => $request->video_title,
            'video_description' => $request->video_description,
            'video_thumbnail_url' => $request->video_thumbnail_url,
            'youtube_video_url' => $request->youtube_video_url,
            'video_duration' => $request->video_duration,
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Video created successfully', 'video' => $video], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Video  $video
     * @return Response
     */
    public function show(Video $video)
    {
        // Return the specified video as a JSON response
        return response()->json($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Video  $video
     * @return Response
     */
    public function update(Request $request, Video $video)
    {
        // Validate the incoming request data
        $request->validate([
            'video_title' => 'required|string|max:255',
            'video_description' => 'nullable|string',
            'video_thumbnail_url' => 'nullable|string|max:255',
            'youtube_video_url' => 'required|string|max:255',
            'video_duration' => 'nullable|integer',
        ]);

        // Update the video record
        $video->update([
            'video_title' => $request->video_title,
            'video_description' => $request->video_description,
            'video_thumbnail_url' => $request->video_thumbnail_url,
            'youtube_video_url' => $request->youtube_video_url,
            'video_duration' => $request->video_duration,
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Video updated successfully', 'video' => $video]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Video  $video
     * @return Response
     */
    public function destroy(Video $video)
    {
        // Delete the video record
        $video->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Video deleted successfully']);
    }
}
