<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $fillable = [
        'id' , 'stor_id' , 'group_id' , 'Fname' , 'Lname' , 'email' , 'country' ,
        'phone' , 'brithday' , 'gender',
    ];
}
