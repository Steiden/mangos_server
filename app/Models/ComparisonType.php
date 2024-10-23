<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComparisonType extends Model
{
    use HasFactory;

    protected $table = 'comparison_types';
    protected $fillable = ['name'];
}
