<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutionStatus extends Model
{
    use HasFactory;

    protected $table = 'execution_statuses';
    protected $fillable = ['name'];
}
