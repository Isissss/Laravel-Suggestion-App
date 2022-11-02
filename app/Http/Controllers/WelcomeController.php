<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show()
    {
      return view('about', [
          'webtitle' => "Suggestions",
          'text' => "Dit is een test"
      ]);
    }
}
