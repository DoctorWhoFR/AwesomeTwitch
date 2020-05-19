<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string name
 * @property mixed|string server_type
 * @property mixed|string location
 * @property mixed|string user_id
 * @property mixed id
 */
class HetznerServer extends Model
{
    //
    /**
     * @var string[]
     */
    protected $attributes = [
        'name', 'server_type', 'location', 'user_id'
    ];

}
