<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'name',
        'description',
        'started_at',
        'finished_at',
        'execution_status_id',
        'task_priority_id',
        'category_id',
        'project_id'
    ];
}
