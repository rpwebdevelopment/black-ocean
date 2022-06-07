<?php

namespace App\Http\Middleware;

use App\Models\GameUser;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameAuth
{
    public function __construct(private GameUser $gameUser)
    {
    }

    public function handle(Request $request, Closure $next, ...$guards)
    {
        $user = Auth::user();
        $gameId = (int) $request->route()->parameter('id');

        if (!$this->gameUser->userHasAccess($user->id, $gameId)) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
