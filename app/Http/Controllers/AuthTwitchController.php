<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Libs\TwitchAPIController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @pi
 * @since 1.0
 * @version 1.0
 *
 * Controller for twitch authentification
 *
 * Class AuthTwitchController
 * @package App\Http\Controllers
 */
class AuthTwitchController extends Controller
{
    //

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @version 1.0
     * @api
     *
     * Callback TwitchAPI
     *
     * @since 1.0
     */
    public function callback(Request $request){
        $tapi = new TwitchAPIController();
        $access_token = $tapi->getAccessToken($request->get('code'));
        $twitch_user = $tapi->getUserInfo($access_token->access_token);

        $db_user = User::firstOrCreate([
            'name' => $twitch_user->name,
            'twitch_id' => $twitch_user->_id,
            'email' => $twitch_user->email
        ]);
        $db_user->twitch_access = $access_token->access_token;
        $db_user->save();

        Auth::login($db_user, true);

        return redirect()->route('home');
    }

    /**
     *
     */
    public function login(){
        $tapi = new TwitchAPIController();
        $url = $tapi->generateUrl("twitch/auth/", "user:edit:follows user_read openid");

        return view('login', ['login'=>$url]);
    }

}
