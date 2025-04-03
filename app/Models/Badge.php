<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }


    public function usersb()
{
    return $this->belongsToMany(User::class)
                ->withPivot('unlocked_at')
                ->withTimestamps();
}

    protected $table = 'User_Badges';
    protected $primaryKey = 'Badges_Id';
}
