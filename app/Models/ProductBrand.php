<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{    
        protected $table = "product_brands";
        protected $fillable =[
            'id' , 'p_id' , 'b_id' ,'stor_id'
        ];
}
