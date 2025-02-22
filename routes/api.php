<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    // Game management routes (Authenticated users only)
    Route::middleware('auth:sanctum')->group(function () {
    // View all games
    Route::get('games', [GameController::class, 'index']);

    // View a specific game
    Route::get('games/{game}', [GameController::class, 'show']);

    // Create a new game
    Route::post('games', [GameController::class, 'store']);

    // Update an existing game
    Route::put('games/{game}', [GameController::class, 'update']);

    // Delete a game
    Route::delete('games/{game}', [GameController::class, 'destroy']);
});
