<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'login',
        'password',
        'avatar',
        'first_name',
        'last_name',
        'patronymic',
        'phone',
        'email',
        'is_subordinate',
        'verified_at',
        'post_id',
        'user_id'
    ];
}
