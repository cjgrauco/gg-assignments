<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;
use Ilzrv\LaravelSteamAuth\SteamAuth;

class SteamAuthController extends Controller
{
    protected $steamAuth;

    public function __construct(SteamAuth $steamAuth)
    {
        $this->steamAuth = $steamAuth;
    }

    /**
     *
     *
     * @throws \JsonException
     */
    public function login()
    {
        if (!$this->steamAuth->validate()) {
            return $this->steamAuth->redirect();
        }


        $data = $this->steamAuth->getUserData();

        if (is_null($data)) {
            return $this->steamAuth->redirect();
        }

        $cookieInfo = ["personaName" => $data->getPersonaName(), "avatarUrl" => $data->getAvatarFull()];
        $cookie = cookie("userData", json_encode($cookieInfo, JSON_THROW_ON_ERROR), 100);


        return redirect(RouteServiceProvider::PROFILE)->withCookie($cookie);
    }

}
