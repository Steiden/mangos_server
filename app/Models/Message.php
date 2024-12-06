<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'is_read',
        'message_type_id',
        'user_sending_id',
        'user_receiving_id',
        'chat_id',
        'task_id'
    ];
}
