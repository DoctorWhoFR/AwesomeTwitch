<?php


namespace App\Http\Controllers\Libs;

use App\HetznerServer;
use Illuminate\Http\JsonResponse;
use LKDev\HetznerCloud\APIException;
use LKDev\HetznerCloud\HetznerAPIClient;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Twitch API Controller
 *
 * Class TwitchAPIController
 * @package App\Http\Controllers
 */
class HetznerAPIController
{

    /**
     * @var HetznerAPIClient
     */
    public HetznerAPIClient $hetznerClient;

    public function __construct()
    {
        $this->hetznerClient = new HetznerAPIClient("uR4FKEOsO2FtGsAEqFUW9OHgwDflWpXczIGZKkrBEZMbQXcd6HcbUZ3tpg2VHXZF");

    }

    /**
     * @param Session $session
     * @param $name
     * @param $location
     * @param $server_type
     * @param $user_id
     * @param $image
     * @return JsonResponse|true
     * @throws APIException
     */
    public function createServer(Session $session, $name, $location, $server_type, $user_id, $image){
        $server_type = $this->hetznerClient->serverTypes()->getByName($server_type);
        $image = $this->hetznerClient->images()->getById($image);
        $location = $this->hetznerClient->locations()->getById($location);

        // TODO: trow error if error under the creation of the hetnzer server
        try {
            $action = $this->hetznerClient->servers()->createInLocation($name, $server_type, $image, $location);
        } catch (APIException $e) {
            return response()->json($e);
        }

        var_dump($session->get('test'));

        $server = new HetznerServer();
        $server->name = $name;
        $server->location = $location;
        $server->server_type = $server_type;
        $server->user_id = $user_id;
        $server->create_at = time();

        $server->save();

        return true;
    }

}
