<?php

namespace App\Http\Livewire;

use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class FriendSearch extends Component
{
    private User $currentUser;
    private Friend $friendModel;
    public ?Collection $users;
    public array $friends = [];
    public ?Collection $pendingRequests;
    public string $userInput = '';

    protected $listeners = [
        'userSearch' => 'getUsers',
        'sendRequest',
        'acceptRequest',
        'rejectRequest',
        'removeFriend',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->friendModel = app()->make(Friend::class);
        $this->getData();
    }

    public function render(): View
    {
        return view('livewire.friend-search');
    }

    public function getData(): void
    {
        $this->currentUser = Auth::user();
        $this->pendingRequests = FriendRequest::query()
            ->where('for_user_id', '=', $this->currentUser->id)
            ->where('rejected', '=', false)
            ->where('accepted', '=', false)
            ->get();

        $this->friends = $this->friendModel->getUserFriends();
    }

    public function getUsers(): void
    {
        if ($this->userInput === '') {
            $this->users = null;
            return;
        }

        $searchString = sprintf(
            '%%%s%%',
            $this->userInput
        );

        $this->users = User::query()
            ->where('id', '<>', $this->currentUser->id)
            ->where(function($query) use ($searchString) {
                $query->where('username', 'LIKE', $searchString)
                    ->orWhere('email', 'LIKE', $searchString);
            })
            ->whereNotIn('id', $this->friendModel->getCurrentFriendIds())
            ->get();
    }

    public function sendRequest(int $id): void
    {
        $exists = FriendRequest::query()
            ->where('requested_by_user_id', '=', $this->currentUser->id)
            ->where('for_user_id', '=', $id)
            ->exists();

        if ($exists) {
            $this->addError('exists', 'Friend request already sent.');
            return;
        }

        $request = new FriendRequest(
            [
                'requested_by_user_id' => $this->currentUser->id,
                'for_user_id' => $id,
            ]
        );
        $request->save();
        session()->flash('sent', 'Friend request sent.');
    }

    public function acceptRequest(int $id): void
    {
        $request = FriendRequest::find($id);
        $request->accepted = true;
        $request->save();

        $friend = new Friend(
            [
                'user_id' => $request->for_user_id,
                'friend_user_id' => $request->requested_by_user_id,
            ]
        );
        $friend->save();

        $friend = new Friend(
            [
                'user_id' => $request->requested_by_user_id,
                'friend_user_id' => $request->for_user_id,
            ]
        );
        $friend->save();

        $this->getData();
    }

    public function rejectRequest(int $id): void
    {
        $request = FriendRequest::find($id);
        $request->rejected = true;
        $request->save();

        $this->getData();
    }

    public function removeFriend(int $id): void
    {
        $friend = Friend::query()
            ->where('user_id', '=', $id)
            ->where('friend_user_id', '=', $this->currentUser->id)
            ->first();
        $friend->delete();

        $friend = Friend::query()
            ->where('friend_user_id', '=', $id)
            ->where('user_id', '=', $this->currentUser->id)
            ->first();
        $friend->delete();

        $this->getData();
    }
}
