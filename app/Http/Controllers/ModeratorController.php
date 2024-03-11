<?php

namespace App\Http\Controllers;

use App\Models\Moderator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('moderator.admin')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $moderators = Moderator::all();
        return response()->json($moderators);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $moderator = Moderator::create($request->all());

        return response()->json(['message' => 'Moderator created successfully', 'moderator' => $moderator], 201);
    }

    public function show($id)
    {
        $moderator = Moderator::findOrFail($id);
        return response()->json($moderator);
    }

    public function update(Request $request, $id)
    {
        $moderator = Moderator::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $moderator->update($request->all());

        return response()->json(['message' => 'Moderator updated successfully', 'moderator' => $moderator]);
    }

    public function destroy($id)
    {
        $moderator = Moderator::findOrFail($id);
        $moderator->delete();

        return response()->json(['message' => 'Moderator deleted successfully']);
    }
}
