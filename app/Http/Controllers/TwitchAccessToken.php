<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class TwitchAccessToken
{
    public static function get(): string
    {
        $oauth = new Client([
            'base_uri' => 'https://id.twitch.tv/',
        ]);

        return json_decode($oauth->post('oauth2/token', [
            'form_params' => [
                'client_id' => config('twitch.client_id'),
                'client_secret' => config('twitch.client_secret'),
                'grant_type' => 'client_credentials'
            ]
        ])->getBody())->access_token;
    }
}
