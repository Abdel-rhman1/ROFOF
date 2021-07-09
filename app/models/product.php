<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'address',
        'price',
        'depart',
        'quantity',
        'avilable'
    ];
    protected $hidden = [
        '',
        '',
        '',
        '',
        '',
    ];
    public $timestamp = false;
}
