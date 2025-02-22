<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Display a listing of the games
    public function index()
    {
        #return Game::all();
        return Game::where('user_id', auth()->id())->get();
    }

    // Display a specific game
    public function show(Game $game)
    {
        return $game;
    }

    // Store a newly created game
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:255',
        ]);

        $game = Game::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'genre' => $request->genre,
            'user_id' => $request->user()->id,  // Assign user ID
        ]);

        return response()->json($game, 201);
    }

    // Update an existing game
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:255',
        ]);

        $game->update($request->all());

        return response()->json($game);
    }

    // Delete a game
    public function destroy(Game $game)
    {
        $game->delete();

        return response()->json(null, 204);
    }
}
