<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
{
    $users = User::orderBy('username')->get();


    $previousChats = Message::where('sender_id', auth()->id())
                            ->orWhere('receiver_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->get();

    $chatUsers = collect();
    foreach ($previousChats as $chat) {
        $otherUserId = $chat->sender_id == auth()->id() ? $chat->receiver_id : $chat->sender_id;
        $otherUser = User::find($otherUserId);

        if ($otherUser && !$chatUsers->has($otherUserId)) {
            $otherUser->lastMessage = $chat;
            $chatUsers->put($otherUserId, $otherUser);
        }
    }

    return view('messages.index', compact('users', 'chatUsers'));
}

public function show(User $user)
{
    $users = User::orderBy('username')->get();

    $previousChats = Message::where('sender_id', auth()->id())
                            ->orWhere('receiver_id', auth()->id())
                            ->distinct() 
                            ->get(['sender_id', 'receiver_id']);


    $chatUsers = collect();
    foreach ($previousChats as $chat) {
        $chatUsers->push(User::find($chat->sender_id == auth()->id() ? $chat->receiver_id : $chat->sender_id));
    }


    $messages = Message::where(function($query) use ($user) {
        $query->where('sender_id', auth()->id())->where('receiver_id', $user->User_id);
    })->orWhere(function($query) use ($user) {
        $query->where('sender_id', $user->User_id)->where('receiver_id', auth()->id());
    })->orderBy('created_at', 'asc')->get();

    $lastMessage = Message::where(function($query) use ($user) {
                            $query->where('sender_id', auth()->id())->where('receiver_id', $user->User_id);
                        })->orWhere(function($query) use ($user) {
                            $query->where('sender_id', $user->User_id)->where('receiver_id', auth()->id());
                        })
                        ->latest('created_at')
                        ->first();

    return view('messages.index', compact('users', 'messages', 'user', 'chatUsers', 'lastMessage'));
}

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,User_id',
            'message_text' => 'required|string',
        ]);

        $data = new Message;
        $data->sender_id = auth()->id();
        $data->receiver_id = $request->receiver_id;
        $data->message_text = $request->message_text;
        $data->Save();

        return redirect()->route('messages.show', $request->receiver_id);
    }
}
