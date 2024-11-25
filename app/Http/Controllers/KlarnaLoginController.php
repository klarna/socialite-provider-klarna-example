<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class KlarnaLoginController extends Controller
{
  public function login()
  {
    return view('login');
  }

  public function redirectToKlarna()
  {
    // Config can be overwritten here if need
    /*
    $clientId = "";
    $clientSecret = "";
    $redirectUrl = "";
    $config = new \SocialiteProviders\Manager\Config($clientId, $clientSecret, $redirectUrl);
    Socialite::driver('klarna')->setConfig($config)->scopes([])->redirect();
    */

    return Socialite::driver('klarna')->scopes(['openid', 'offline_access', 'profile:name', 'profile:email', 'profile:phone'])->redirect();
  }

  public function handleCallback()
  {
    $user = Socialite::driver('klarna')->user();
    Log::info('User', ['user' => $user]);

    return view('callback', ['user' => $user]);
  }
}
