<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'users';
    protected $fillable = [
        'login',
        'password',
        'avatar',
        'first_name',
        'second_name',
        'patronymic',
        'phone',
        'email',
        'verified_at',
    ];
}
