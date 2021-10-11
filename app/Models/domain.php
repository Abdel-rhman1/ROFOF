<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class domain extends Model
{
    protected $table = "domains";
    
    protected $fillable =[
        'id' , 'vendor_id' ,'stor_id' , 'stor_url'
    ];
}
