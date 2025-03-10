<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['Sender_Id', 'Receiver_Id', 'Message_Text'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'Sender_Id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'Receiver_Id');
    }
}
