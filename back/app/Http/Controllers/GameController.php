<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function show() {
        $response = [
            'games' => Game::all()
        ];

        return response($response, 200);        
    }

    public function store(Request $request ){
        request()->validate([
            'name'=>'required'
        ]);

        return Game::create([
            'name' => request('name')
        ]);
    }
    public function destroy(Game $game){
        $success = $game->delete();

        return[
            'success' => $success
        ];
    }
}
