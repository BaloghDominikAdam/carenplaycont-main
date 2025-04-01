<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'player';
    protected $primaryKey = 'Player_Id';
    public $timestamps = false;
}
