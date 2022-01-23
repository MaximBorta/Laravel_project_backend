<?php

namespace App\Http\Controllers;

use App\Events\UserOffline;
use App\Models\User;
use Illuminate\Http\Request;

class UserOfflineController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __invoke(User $user)
    {
        $user->status = 'offline';
        $user->save();
        broadcast(new UserOffline($user));
    }
}
