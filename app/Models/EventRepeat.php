<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRepeat extends Model
{
    use HasFactory;

    protected $table = 'event_repeats';
    protected $fillable = ['name'];
}
