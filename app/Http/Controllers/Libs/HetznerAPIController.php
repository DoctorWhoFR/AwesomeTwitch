<?php


namespace App\Http\Controllers\Libs;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use LKDev\HetznerCloud\HetznerAPIClient;

/**
 * Twitch API Controller
 *
 * Class TwitchAPIController
 * @package App\Http\Controllers
 */
class HetznerAPIController
{
    public function __construct()
    {
        $hetznerClient = new HetznerAPIClient("");
        foreach ($hetznerClient->servers()->all() as $server) {
            echo 'ID: '.$server->id.' Name:'.$server->name.' Status: '.$server->status.PHP_EOL;
        }
    }

}
