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

    public function index(Request $request){
        $user = Auth::user();
        $overleys = Auth::user()->overlay;

        return view('overlay.index',['overlays'=>$overleys]);
    }

    public function generateOverlay(){
        $user = Auth::user();

        $overlay = Overlay::create([
            'followers'=>"test",
            'overlay_code'=>$this->generateUUID(),
            'user_id'=>Auth::id()
        ]);

        return redirect("http://127.0.0.1:8000/twitch/overlay" . "/" . Auth::id() . "/" . $overlay->overlay_code);
    }

    public function OverlayFaker(Request $request){
        if($request->get('faker') == null || $request->get('overlay') == null){ return redirect()->route('twitch.overlay'); }

        $overlay = Overlay::find($request->get('overlay'));

        $overlay->followers = "null";
        $overlay->save();

        return redirect()->route('twitch.overlay');
    }

    public function overlay($id, $overlay_code){

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


        return view('overlay', ['followers'=>$followers, 'followed'=>$followed]);
    }
}
