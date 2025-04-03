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
        $users = User::where('User_id', '!=', auth()->id())
                   ->orderBy('username')
                   ->get();

        $chatUsers = User::whereHas('sentMessages', function($query) {
                        $query->where('receiver_id', auth()->id());
                    })
                    ->orWhereHas('receivedMessages', function($query) {
                        $query->where('sender_id', auth()->id());
                    })
                    ->with(['sentMessages' => function($query) {
                        $query->where('receiver_id', auth()->id())
                              ->orderBy('created_at', 'desc')
                              ->limit(1);
                    }, 'receivedMessages' => function($query) {
                        $query->where('sender_id', auth()->id())
                              ->orderBy('created_at', 'desc')
                              ->limit(1);
                    }])
                    ->get()
                    ->map(function($user) {
                        $lastSent = $user->sentMessages->first();
                        $lastReceived = $user->receivedMessages->first();

                        if ($lastSent && $lastReceived) {
                            $user->lastMessage = $lastSent->created_at > $lastReceived->created_at
                                ? $lastSent
                                : $lastReceived;
                        } elseif ($lastSent) {
                            $user->lastMessage = $lastSent;
                        } else {
                            $user->lastMessage = $lastReceived;
                        }

                        return $user;
                    })
                    ->sortByDesc(function($user) {
                        return $user->lastMessage ? $user->lastMessage->created_at : null;
                    });

        return view('messages.index', compact('users', 'chatUsers'));
    }

    public function show(User $user)
    {
        $users = User::where('User_id', '!=', auth()->id())
                   ->orderBy('username')
                   ->get();

        $chatUsers = User::whereHas('sentMessages', function($query) {
                        $query->where('receiver_id', auth()->id());
                    })
                    ->orWhereHas('receivedMessages', function($query) {
                        $query->where('sender_id', auth()->id());
                    })
                    ->with(['sentMessages' => function($query) {
                        $query->where('receiver_id', auth()->id())
                              ->orderBy('created_at', 'desc')
                              ->limit(1);
                    }, 'receivedMessages' => function($query) {
                        $query->where('sender_id', auth()->id())
                              ->orderBy('created_at', 'desc')
                              ->limit(1);
                    }])
                    ->get()
                    ->map(function($user) {
                        $lastSent = $user->sentMessages->first();
                        $lastReceived = $user->receivedMessages->first();

                        if ($lastSent && $lastReceived) {
                            $user->lastMessage = $lastSent->created_at > $lastReceived->created_at
                                ? $lastSent
                                : $lastReceived;
                        } elseif ($lastSent) {
                            $user->lastMessage = $lastSent;
                        } else {
                            $user->lastMessage = $lastReceived;
                        }

                        return $user;
                    })
                    ->sortByDesc(function($user) {
                        return $user->lastMessage ? $user->lastMessage->created_at : null;
                    });

                    $messages = Message::with(['sender', 'receiver'])
                    ->where(function($query) use ($user) {
                        $query->where('sender_id', auth()->id())
                              ->where('receiver_id', $user->User_id);
                    })
                    ->orWhere(function($query) use ($user) {
                        $query->where('sender_id', $user->User_id)
                              ->where('receiver_id', auth()->id());
                    })
                    ->orderBy('created_at', 'asc')
                    ->get();

        return view('messages.index', compact('users', 'messages', 'user', 'chatUsers'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,User_id',
            'message_text' => 'required|max:255',
        ], []);

        Message::create([
            'Sender_Id' => auth()->id(),
            'Receiver_Id' => $request->receiver_id,
            'Message_Text' => $request->message_text,
            'New_Message' => 1
        ]);

        return redirect()->route('messages.show', $request->receiver_id);
    }
}
