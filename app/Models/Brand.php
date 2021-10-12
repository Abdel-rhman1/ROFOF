<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";
    protected $fillable = [
        'id' , 'stor_id' , 'details' , 'brandName' , 'banarIamge' , 'brandLogo' ,'pagetitle'
        ,'pageDescription',
    ];
}
