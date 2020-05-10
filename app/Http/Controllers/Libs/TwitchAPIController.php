<?php


namespace App\Http\Controllers\Libs;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Twitch API Controller
 *
 * Class TwitchAPIController
 * @package App\Http\Controllers
 */
class TwitchAPIController
{


    public function generateUrl($redirect_uri, $scopes){
        $to = Url::to('/twitch/auth/');
        $url = "https://id.twitch.tv/oauth2/authorize?redirect_uri=".$to."&response_type=code&scope=" . $scopes . "&client_id=k6dtt6boszj5nwtldal2wjikor51s3";
        return $url;
    }

    /**
     * @param $code
     * @return bool|string|void
     * @since 1.0
     * @version 1.0
     * @api
     *
     * Twitch function for getting access token
     */
    public function getAccessToken($code){
        $curl = curl_init();
        $url = "https://id.twitch.tv/oauth2/token?client_id=k6dtt6boszj5nwtldal2wjikor51s3&client_secret=d8ms8otqqgkluds7evnlyefgm41ewg&code=" . $code . "&grant_type=authorization_code&redirect_uri=http://localhost:8000/twitch/auth/";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Cookie: unique_id=48d43220883f0507; unique_id_durable=48d43220883f0507; twitch.lohp.countryCode=FR"
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

    /**
     * @param User $user
     * @return mixed|void
     */
    public function getUserInfo($access_token){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitch.tv/kraken/user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: OAuth " . $access_token,
                "Client-ID: k6dtt6boszj5nwtldal2wjikor51s3",
                "Accept: application/vnd.twitchtv.v5+json",
                "Cookie: unique_id=48d43220883f0507; unique_id_durable=48d43220883f0507; twitch.lohp.countryCode=FR"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    /**
     * @param User $user
     */
    public function getFollowers(User $user){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitch.tv/helix/users/follows?first=1&to_id=478525370",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{\r\n    \"jsonrpc\": \"2.0\",\r\n    \"id\": 1,\r\n    \"method\": \"getScenes\",\r\n    \"params\": {\r\n        \"resource\": \"ScenesService\"\r\n    }\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Client-ID: k6dtt6boszj5nwtldal2wjikor51s3",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Bearer " . $user->twitch_access,
                "Content-Type: application/json",
                "Cookie: unique_id=48d43220883f0507; unique_id_durable=48d43220883f0507; twitch.lohp.countryCode=FR"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}
