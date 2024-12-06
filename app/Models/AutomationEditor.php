<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomationEditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'automation_id',
        'user_id'
    ];
}
