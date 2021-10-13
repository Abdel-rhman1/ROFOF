<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produc extends Model
{
    protected $table =  "products";
    protected $fillable = [
        'id' ,'name', 'stor_id' , 'type' , 'employeer_id' , 'price'
        ,'qty' , 'unlimitedOrNot' , 'alert_quantity' , 'remaining' , 'mainImage' ,'viedo',
        'moreThanImage' , 'is_variant' , 'is_diffPrice'
    ];
}
