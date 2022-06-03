<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class FriendSearch extends Component
{
    public ?Collection $users;
    public string $userInput = '';

    protected $listeners = [
        'userSearch' => 'getUsers'
    ];

    public function render(): View
    {
        return view('livewire.friend-search');
    }

    public function getUsers(): void
    {
        if ($this->userInput === '') {
            $this->users = null;
            return;
        }

        $currentUser = Auth::user();
        $searchString = sprintf(
            '%%%s%%',
            $this->userInput
        );

        $this->users = User::query()
            ->where('id', '<>', $currentUser->id)
            ->where(function($query) use ($searchString) {
                $query->where('username', 'LIKE', $searchString)
                    ->orWhere('email', 'LIKE', $searchString);
            })
            ->get();
    }
}
