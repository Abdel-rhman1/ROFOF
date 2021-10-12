<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{


    protected $table = "categories";
    protected $fillable = [
        'id' , 'stor_id' , 'parent' , 'name' , 'visiable','hidden_Products',
    ];
}
