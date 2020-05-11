<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overlay extends Model
{
    //
    protected $fillable = [
        'name', 'followers', 'overlay_code', 'user_id', 'custom', 'code'
    ];

}
