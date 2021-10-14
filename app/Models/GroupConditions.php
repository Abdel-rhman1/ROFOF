<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupConditions extends Model
{
    protected $table = "group_conditions";
    protected $fillable = [
        'id' , 'stor_id' , 'group_id' , 'conditionType' , 'condition'
        ,'value'
    ];
}
