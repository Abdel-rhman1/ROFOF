<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stor extends Model
{
    protected $table = "stors";
    
    protected $fillable = [
        'vendor_id' , 'plan_id' , 'name' , 'domain_id' , 'stor_type' , 'id' , 'invitation_cubon'
    ];
    protected $hidden = [

    ];
}
