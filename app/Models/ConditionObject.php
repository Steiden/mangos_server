<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionObject extends Model
{
    use HasFactory;

    protected $table = 'condition_objects';
    protected $fillable = ['task_id', 'event_id'];
}
