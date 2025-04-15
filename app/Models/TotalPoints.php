<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalPoints extends Model
{
    protected $table = 'total_points';
    protected $primaryKey = 'Total_Points_Id';
    public $timestamps = false;

    protected $fillable = [
        'User_Id',
        'username',
        'Total_Points'
    ];
}
