<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends ApiController
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login", "register"]]);
    }

    public function index()
    {
        $friends = UserResource::collection(User::where('id', '!=', Auth::id())->get());

        return $this->respond($friends);
    }

    public function get_one($id)
    {
        $friend = UserResource::collection(User::where('id', '=', $id)->get());
        return $this->respond($friend);
    }
}
