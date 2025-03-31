<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $table = 'user_messages';
    protected $primaryKey = 'Message_Id';
    public $timestamps = false;

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'User_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'User_id');
    }




    protected $fillable = ['Sender_Id', 'Receiver_Id', 'Message_Text'];
}
