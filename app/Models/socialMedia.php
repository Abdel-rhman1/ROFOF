<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class socialMedia extends Model
{
    protected $table = "social_media";
    protected $fillable = [
        'id','stor_id', 'instgram','twitter','facebook','youtube','snapchat','tiktok'
    ];
}
