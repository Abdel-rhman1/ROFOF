<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    protected $table = "product_cats";
    protected $fillable = [
        'id' , 'cat_id' , 'product_id' , 'stor_id'
    ];
}
