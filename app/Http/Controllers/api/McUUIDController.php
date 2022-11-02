<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class McUUIDController extends Controller
{
    public function __invoke($name) {
        $response = Http::get('https://api.mojang.com/users/profiles/minecraft/'.$name);

        if ($response->successful()) {
            return $response->json();
        }

        return response($response->json([]));
    }
}
