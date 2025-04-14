<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'games_review';
    protected $primaryKey = 'Games_Review_Id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'Games_Review_User_Id'); // Itt a 'user_id' a communityfeed táblában lévő mező neve
    }
}
