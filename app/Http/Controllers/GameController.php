<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameShip;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        return view('games');
    }

    public function show(int $id)
    {
        $game = Game::find($id);
        $currentUser = Auth::user();
        $isGM = $game->getGM()->id === $currentUser->id;

        $ship = $game->ships()
            ->where('active', '=', true)
            ->first();

        return view(
            'game',
            [
                'id' => $id,
                'ship' => $ship,
                'is_gm' => $isGM,
            ]
        );
    }
}
