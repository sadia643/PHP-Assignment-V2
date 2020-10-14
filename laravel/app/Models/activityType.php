<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activityType extends Model
{
    use HasFactory;
	
	protected $table = 'activity_types';

    protected $fillable = ['types'];
}
