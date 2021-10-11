<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class storActivities extends Model
{
    protected $table = "stor_activities";
    protected $fillable = [
        'id', 'stor_id','Activities',
    ];
}
