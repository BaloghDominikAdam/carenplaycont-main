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
        return view('messages.index', compact('users'));
    }

    public function show(User $user)
    {
        $users = User::orderBy('username')->get();
        $messages = Message::where(function($query) use ($user) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $user->User_id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->User_id)->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return view('messages.index', compact('users', 'messages', 'user'));
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
