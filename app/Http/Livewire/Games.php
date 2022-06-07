<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\GameUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Games extends Component
{
    public array $games = [];
    public string $newGameName = '';

    protected $listeners = [
        'addGame'
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->getAllGamesData();
    }

    public function render()
    {
        return view('livewire.games');
    }

    public function addGame()
    {
        $this->validate(
            [
                'newGameName' => 'required|min:1|max:200',
            ]
        );

        $user = Auth::user();

        $game = new Game(
            [
                'name' => $this->newGameName,
            ]
        );
        $game->save();

        $gameUser = new GameUser(
            [
                'game_id' => $game->id,
                'user_id' => $user->id,
                'is_gm' => true,
            ]
        );
        $gameUser->save();
        $this->dispatchBrowserEvent('close-game-modal');
        $this->getAllGamesData();
    }

    public function getAllGamesData()
    {
        $this->games = [];
        /** @var User $user */
        $user = Auth::user();
        $userGames = $user->games()->get();
        /** @var GameUser $gameUser */
        foreach ($userGames as $gameUser) {
            /** @var Game $game */
            $game = $gameUser->game()->first();
            $gameUsers = $game->getAllUsers();
            $this->games[] = [
                'game' => $game,
                'gm' => $gameUsers['gm'] ?? null,
                'users' => $gameUsers['players'] ?? [],
            ];
        }
    }
}
