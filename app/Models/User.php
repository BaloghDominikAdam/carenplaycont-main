<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $table = 'users';
    protected $primaryKey = 'User_id';
    public $timestamps = false;

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'Sender_Id', 'User_Id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'Receiver_Id', 'User_Id');
    }


    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_achieved_badges', 'User_Id', 'Badges_Id');
    }

}
