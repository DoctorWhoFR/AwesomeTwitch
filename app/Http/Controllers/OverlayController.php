<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Libs\TwitchAPIController;
use App\Overlay;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OverlayController extends Controller
{
    protected $user;

    /**
     * Index for overlay management and creation
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $user = Auth::user();
        $overleys = null;

        if(Auth::user()->overlay){
            $overleys =  Auth::user()->overlay;
        }

        return view('overlay.index',['overlays'=>$overleys]);
    }

    /**
     * Generate a new overlay
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since 1.0
     * @version 1.0
     */
    public function generateOverlay(Request$request){
        $user = Auth::user();

        $overlay = Overlay::create([
            'name' => $request->get('name'),
            'followers'=> "test",
            'overlay_code'=>$this->generateUUID(),
            'user_id'=>Auth::id()
        ]);

        return redirect()->route('twitch.overlay');
    }

    /**
     * Overlay faker
     *
     * Current Faker: Follower
     * Planned: Sub, Gift
     *
     * @since 1.0
     * @version 1.0
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function OverlayFaker(Request $request){
        if($request->get('faker') == null || $request->get('overlay') == null){ return redirect()->route('twitch.overlay'); }

        $overlay = Overlay::find($request->get('overlay'));

        $overlay->followers = "null";
        $overlay->save();

        return redirect()->route('twitch.overlay');
    }

    /**
     * Followers alerts render function
     *
     * @param $id
     * @param $overlay_code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function followers_alert($id, $overlay_code){

        $overlay = Overlay::where(['overlay_code'=>$overlay_code])->get();

        if($overlay[0] == null){return redirect()->route('twitch.overlay');}

        $tapi = new TwitchAPIController();

        try {
            /**
             * @var $user User
             */
            $followers = $tapi->getFollowers(User::find($id));
            $last = $overlay[0]->followers;
            $followed = false;

            if($last != $followers->data[0]->from_name){

                $overlay[0]->followers = $followers->data[0]->from_name;
                $overlay[0]->save();

                $followed = true;

            }


        } catch (\Exception $e) {

        }


        return view('overlay.overlay', ['followers'=>$followers, 'followed'=>$followed]);
    }



}
