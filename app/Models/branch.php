<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{

    protected $table = "branches";
    
    
    protected $fillable = [
        'id' ,'vendor_id','stor_id','mainBranch','Name','country','city','address'
        ,'postal_code','street','state','phone','mobile','whattsap','period','uponrecipt',
        'uponreciptcost','sun','mon','tues','wend','thur','fri','sta'
    ];
    protected $hidden = [

    ];

}
