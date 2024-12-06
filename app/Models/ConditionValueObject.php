<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionValueObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_name',
        'value',
        'tag_id',
        'category_id',
        'execution_status_id',
        'task_priority_id'
    ];
}
