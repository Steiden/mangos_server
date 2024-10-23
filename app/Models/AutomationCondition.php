<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomationCondition extends Model
{
    use HasFactory;

    protected $table = 'automation_conditions';
    protected $fillable = [
        'condition_object_id',
        'comparison_type_id',
        'condition_value_object_id'
    ];
}
