<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'player';
    protected $primaryKey = 'Game_Played_Id';
    public $timestamps = false;

    protected $fillable = [
        'Player_Id',
        'Player_Username',
        'Player_Points',
        'Played_Game_Name'
    ];
}
