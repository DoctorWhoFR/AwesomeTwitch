<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Libs\TwitchAPIController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        $tapi = new TwitchAPIController();
        $url = $tapi->generateUrl("twitch/auth/", "user:edit:follows user_read openid");
        $user = Auth::user();

        $followers = $tapi->getFollowers($user);

        return view('home', ['twitch_api'=>$url, 'followers'=>$followers]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
