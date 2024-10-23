<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';
    protected $fillable = ['full_name', 'name', 'address', 'phone', 'activity_type_id', 'chat_id'];
}
