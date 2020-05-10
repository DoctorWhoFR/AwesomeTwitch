<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function generateUUID(){
        return file_get_contents('https://www.uuidgenerator.net/api/version4/1');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
