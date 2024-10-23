<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    use HasFactory;

    protected $table = 'automations';
    protected $fillable = [
        'name',
        'automation_action_id',
        'automation_condition_id',
        'project_id'
    ];
}
