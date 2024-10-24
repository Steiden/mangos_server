<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = [
        'text',
        'message_type_id',
        'is_read',
        'user_sending_id',
        'user_receiving_id',
        'user_id',
        'chat_id',
        'task_id'
    ];
}
