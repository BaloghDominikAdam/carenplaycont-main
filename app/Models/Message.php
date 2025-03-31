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


    public function sender()
    {
        return $this->belongsTo(User::class, 'Sender_Id', 'User_id');
        // 'Sender_Id' az üzenet küldőjének azonosítója a messages táblában
        // 'User_id' a users tábla elsődleges kulcsa
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'Receiver_Id', 'User_id');
    }




    protected $fillable = ['Sender_Id', 'Receiver_Id', 'Message_Text'];
}
