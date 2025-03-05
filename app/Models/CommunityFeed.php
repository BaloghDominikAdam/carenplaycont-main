<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityFeed extends Model
{
    protected $table = 'communityfeed';
    protected $primaryKey = 'comm_Id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'User_Id'); // Itt a 'user_id' a communityfeed táblában lévő mező neve
    }


}
