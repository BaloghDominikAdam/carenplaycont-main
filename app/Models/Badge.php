<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    // public function users()
    // {
    //     return $this->belongsToMany(User::class)->withTimestamps();
    // }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achieved_badges', 'badge_id', 'user_id');
    }

    protected $table = 'user_badges';
    protected $primaryKey = 'Badges_Id';
    public $timestamps = false;
}
