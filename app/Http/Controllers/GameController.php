<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Display a listing of the games
    public function index(Request $request)
	    {

		$query = Game::query();
    		// If the use is not the Admin then show him only his games for the Dashboard functionality requested in the specs
 		if (auth()->user()->role !== 'admin') {
       		    $query->where('user_id', auth()->id());  
    		}

    		// Filter by genre if provided
    		if ($request->has('genre')) {
        		$query->where('genre', $request->genre);
    		}

    		// Sort by release date if requested
    		if ($request->has('sort_by') && $request->sort_by === 'release_date') {
        		$query->orderBy('release_date');
    		}

    		// Return the filtered and/or sorted games
    		return $query->get();
    }

    // Display a specific game
    public function show(Game $game)
    {
    	if ($game->user_id === auth()->id() || auth()->user()->role === 'admin') {
            return $game;
    	}
    
    	return response()->json(['error' => 'Unauthorized, if the game exists, only the owner and/or Admin can view it'], 403);
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

	//Check if the game already exists
	$duplicateGame = Game::where('title', $request->title)
                       ->where('release_date', $request->release_date)
                       ->where('user_id', auth()->id()) // check for the logged-in user's games
                       ->first();

    	if ($duplicateGame) {
            return response()->json(['error' => 'This game already exists.'], 400);
   	}

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

	if ($game->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized, if the game exists, only the owner and/or Admin can update it'], 403);
    	}

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

	if (auth()->user()->role === 'admin' || $game->user_id === auth()->id()) {
        	$game->delete();
        	return response()->json(null, 204);  
    	}

    	return response()->json(['error' => 'Unauthorized, if the game exists, only the owner and/or Admin can delete it'], 403);

    	}
}
