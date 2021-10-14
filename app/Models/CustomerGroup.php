<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table = "customer_groups";
    protected $fillable = [
        'id' , 'stor_id' , 'name' , 'paymentMethod' , 'transactionMethod',
    ];

}
