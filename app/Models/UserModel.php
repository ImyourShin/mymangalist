<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role',
        'status',
        'profile_img',
        'join_date'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
