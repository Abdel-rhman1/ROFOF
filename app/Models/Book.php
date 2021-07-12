<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = '_book';
    protected $fillable = [
        'name','details','Price','auther'
    ];
    public $timestamp = false;
}
