<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stor extends Model
{
    protected $table = "stors";
    
    protected $fillable = [
        'vendor_id' ,'stor_link' , 'plan_id' , 'name' , 'stor_type' , 'id' , 'invitation_cubon'
    ];
    protected $hidden = [

    ];
}
