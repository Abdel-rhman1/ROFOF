<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CusGroupConditions extends Model
{
    protected $table = "group_conditions";
    protected $fillable = [
        'id' , 'stor_id' , 'group_id' , 'conditionToJoinType' , 'conditionToJoin' , 
        'conditionValue',
    ];
}