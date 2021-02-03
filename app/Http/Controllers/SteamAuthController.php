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
     * Get user data and login
     *
     * @throws \JsonException
     */
    public function login()
    {
        Log::debug("login()");
        if (!$this->steamAuth->validate()) {
            return $this->steamAuth->redirect();
        }
        Log::debug("user validated");


        $data = $this->steamAuth->getUserData();

        if (is_null($data)) {
            return $this->steamAuth->redirect();
        }

        $cookieInfo = ["personaName" => $data->getPersonaName(), "avatarUrl" => $data->getAvatarFull()];
        $cookie = cookie("userData", json_encode($cookieInfo, JSON_THROW_ON_ERROR), 20);


        return redirect(RouteServiceProvider::PROFILE)->withCookie($cookie);
    }

}
