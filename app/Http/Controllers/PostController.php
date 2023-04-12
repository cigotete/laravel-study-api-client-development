<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(Request $request) {

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->get(
            config('services.api-restful.url') . '/api/v1/posts'
        );

        if ($response->status() == 404) {
            return $response->json('404 Error.');
        }

        $service = $response->json();
        return $service;
    }

    public function store() {

        $response = Http::withHeaders([
            'Accept'    => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->post(
            config('services.api-restful.url') . '/api/v1/posts',
            [
            'name' => 'Dummy text',
            'slug' => 'dummy-text',
            'extract' => 'This is a dummy text extract',
            'body' => 'This is a dummy text body',
            'category_id' => 3,
            'user_id' => auth()->user()->accessToken->service_uid,
            ]
        );

        if ($response->status() == 404) {
            return $response->json('404 Error.');
        }

        $service = $response->json();
        return $service;

    }
}
