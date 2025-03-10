<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message_text' => 'required|string',
        ]);

        $message = UserMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message_text' => $request->message_text,
        ]);

        return response()->json($message);
    }

    public function getMessages($userId)
    {
        // Lekérdezi a felhasználó üzeneteit
        $messages = UserMessage::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })
        ->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })
        ->get();

        return response()->json($messages);
    }
}
