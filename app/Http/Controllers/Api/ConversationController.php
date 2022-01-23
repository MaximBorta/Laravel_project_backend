<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Helpers\Conversation;
use App\Http\Controllers\Controller;
use App\Models\Chat\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends ApiController
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login", "register"]]);
    }

    public function index(User $user)
    {
        $conversation = new Conversation(Auth::user(), $user);

        return $this->respond($conversation->messages(40, true));
    }

    public function store(Request $request, User $user)
    {
        if (!$user) return $this->respondUnprocessable();

        $request->validate([
            'message' => 'required|max:180'
        ]);

        $message = [
            'sender_id' => Auth::id(),
            'recipient_id' => $user->id,
            'body' => $request->message
        ];

        $message = Message::create($message);

         broadcast(new MessageSent($message))->toOthers();
    }

    public function last(User $user = null)
    {
        if ($user) {
            $conversation = new Conversation(Auth::user(), $user);
            return $this->respond($conversation->lastMessage());
        }

        $messages = User::where('id', '!==', Auth::id())->get()->mapWithKeys(function ($user) {
            $conversation = new Conversation(Auth::user(), $user);
            return [$user->id => $conversation->lastMessage()];
        });

        return $this->respond($messages);
    }
}
