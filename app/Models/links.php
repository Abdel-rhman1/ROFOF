<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class links extends Model
{
    protected $table = "links";
    protected $fillable = [
        'stor_id' , 'link' , 'iosApplication' , 'androidApplication' , 'id'
    ];

}
