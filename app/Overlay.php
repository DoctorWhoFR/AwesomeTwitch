<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overlay extends Model
{
    //
    protected $fillable = [
        'followers', 'overlay_code', 'user_id'
    ];

}
