<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use App\Models\User;
use Illuminate\Http\Request;

class UserOnlineController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user)
    {
        $user->status = 'online';
        $user->save();
        broadcast(new UserOnline($user));
    }
}
