<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class footprint extends Model
{
    use HasFactory;
	
	protected $table = 'footprints';

    protected $fillable = ['activity', 'activityType', 'country', 'mode', 'carbonFootprint'];
}
