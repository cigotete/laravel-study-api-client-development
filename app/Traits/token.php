<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Token {

    public function setAccessToken($user, $service){

        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://laravel-study-api-development-cdrsfr.test/oauth/token', [
            'grant_type' => 'password',
            'client_id' => '98a68cfa-b51e-4248-93e4-de535adc7351',
            'client_secret' => 'YC26XHrGrO6n2RowihE6P0ehXXc5OVLnocZXIRIi',
            'username' => request('email'),
            'password' => request('password'),
        ]);

        $access_token = $response->json();

        $user->accessToken()->create([
            'service_uid' => $service['data']['id'],
            'access_token' => $access_token['access_token'],
            'refresh_token' => $access_token['refresh_token'],
            'expires_at' => now()->addSecond($access_token['expires_in'])
        ]);
    }

}