<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\UserBadge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
public function index()
{
    $users = User::where('User_Id', '!=', auth()->id())
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
                          ->orderBy('created_at', 'desc');
                }, 'receivedMessages' => function($query) {
                    $query->where('sender_id', auth()->id())
                          ->orderBy('created_at', 'desc');
                }])
                ->get()
                ->map(function($user) {
                    $user->unread = Message::where('receiver_id', auth()->id())
            ->where('sender_id', $user->User_id)
            ->where('new_message', 1)
            ->count();

                    $lastMessage = Message::where(function($q) use ($user) {
                        $q->where('sender_id', $user->User_id)
                          ->where('receiver_id', auth()->id());
                    })
                    ->orWhere(function($q) use ($user) {
                        $q->where('sender_id', auth()->id())
                          ->where('receiver_id', $user->User_id);

                    })
                    ->latest()
                    ->first();

                $user->lastMessage = $lastMessage;
                return $user;
            })
            ->sortByDesc(function($user) {
                return $user->lastMessage ? $user->lastMessage->created_at : now()->subYear();
            });

    return view('messages.index', compact('users', 'chatUsers'));
}

    public function show(User $user)
{



    Message::where('receiver_id', auth()->id())
        ->where('sender_id', $user->User_id)
        ->update(['new_message' => 0]);
    // 1. Olvasottá jelöljük az aktuális user által fogadott üzeneteket
    Message::where('receiver_id', auth()->id())
        ->where('sender_id', $user->User_id)
        ->where('new_message', 1)
        ->update(['new_message' => 0]);

    // 2. Felhasználólista lekérése
    $users = User::where('User_id', '!=', auth()->id())
               ->orderBy('username')
               ->get();

    // 3. Chat partnerek összeállítása
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
        // Olvasatlan üzenetek
        $user->unread = Message::where('receiver_id', auth()->id())
            ->where('sender_id', $user->User_id)
            ->where('new_message', 1)
            ->count();

        // Utolsó üzenet logika
        $lastMessage = Message::where(function($q) use ($user) {
                $q->where('sender_id', $user->User_id)
                  ->where('receiver_id', auth()->id());
            })
            ->orWhere(function($q) use ($user) {
                $q->where('sender_id', auth()->id())
                  ->where('receiver_id', $user->User_id);
            })
            ->latest()
            ->first();

        $user->lastMessage = $lastMessage;
        return $user;
    })
    ->sortByDesc(function($user) {
        return $user->lastMessage ? $user->lastMessage->created_at : now()->subYear();
    });



    $messages = Message::with([
        'sender:User_Id,username,user_profile_picture',
        'receiver:User_Id,username,user_profile_picture'
    ])
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

        $dbuzenet = Message::where('Sender_Id', auth()->id())
        ->count();

        if($dbuzenet == 10){
            $data = new UserBadge;
            $data->User_Id = auth()->id();
            $data->Badges_Id = 4;
            $data->Achieved_At = now();
            $data->Save();
            return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
        }


        $letezobadge = UserBadge::where('User_Id', auth()->id())
        ->where('Badges_Id', 3)
        ->exists();

        if(!$letezobadge){
            $data = new UserBadge;
            $data->User_Id = auth()->id();
            $data->Badges_Id = 3;
            $data->Achieved_At = now();
            $data->Save();
            return redirect('/profil')->with('success', 'Elértél egy új Badge-et.');
        }
        else{
            return redirect()->route('messages.show', $request->receiver_id);
        }







    }
}
