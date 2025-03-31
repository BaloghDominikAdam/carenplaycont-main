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
        // Összes felhasználó ABC sorrendben
        $users = User::orderBy('username')->get();

        // Az utolsó üzenetek minden beszélgetéspartnerrel
        $latestMessages = Message::whereIn('User_id', function($query) {
            $query->selectRaw('MAX(User_id)')
                  ->from('User_Messages')
                  ->where('sender_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id())
                  ->groupBy(Message::raw('LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)'));
        })->get();

        // Beszélgetéspartnerek gyűjtése az utolsó üzenettel együtt
        $chatUsers = collect();
        foreach ($latestMessages as $message) {
            $otherUserId = $message->sender_id == auth()->id() ? $message->receiver_id : $message->sender_id;
            $otherUser = User::find($otherUserId);

            if ($otherUser) {
                $otherUser->lastMessage = $message;
                $chatUsers->put($otherUserId, $otherUser);
            }
        }

        // Rendezés az utolsó üzenet dátuma szerint csökkenő sorrendben
        $chatUsers = $chatUsers->sortByDesc(function($user) {
            return $user->lastMessage->created_at;
        });

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
