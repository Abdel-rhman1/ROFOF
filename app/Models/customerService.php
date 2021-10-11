<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customerService extends Model
{
    protected $table = "customer_services";
    protected $fillable = [
        'id','stor_id', 'phone','wattsap','mobile','telegram','email'
    ];
}
