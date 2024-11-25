# Sign in with Klarna using Laravel Socialite Provider

## Introduction

This is an example Laravel application that demonstrates the usage of [Sign in with Klarna Laravel Socialite Provider](https://socialiteproviders.com/klarna/).

## Running the application

1. Create an `.env` file by copying the `.env.example` file.
2. Replace KLARNA credentials in the `.env` file.

```
KLARNA_CLIENT_ID=""
KLARNA_CLIENT_SECRET=""
KLARNA_REDIRECT_URI=""
```

You can get the client ID and client secret from merchant portal (generate a new API key and use it as a secret).

The redirect URI should be the URL of the application where the user will be redirected after the authentication. It should be a backend route that will handle the authentication response. The response from Klarna will contain the user details and the refresh token using which you can create a user account in your database.

> 📕 Note: Make sure you register your redirect URI as a valid redirect URI in the merchant portal. Ask your Klarna contact to do this for you.

3. Install the dependencies using composer.

```bash
composer install
```

4. Run the application.

```bash
php artisan serve
```

5. Visit the application in the browser.

```bash
http://localhost:8000/login
```

6. Click on the "Sign in with Klarna" button to start the authentication process.

## Understanding the code

> Follow the official installation documentation of [Socialite Providers](https://socialiteproviders.com/usage/).

1. Add the Klarna provider configuration in the `config/services.php` file.

```php
'klarna' => [
  'client_id' => env('KLARNA_CLIENT_ID'),
  'client_secret' => env('KLARNA_CLIENT_SECRET'),
  'redirect' => env('KLARNA_REDIRECT_URI'),
]
```

2. Add Socialite Manager in the bootstrap providers

```php
<?php

return [
  // other existing providers
  \SocialiteProviders\Manager\ServiceProvider::class
];
```

3. Setup controller and redirect the user to Klarna for authentication.

> Follow the code in `redirectToKlarna` function in [KlarnaLoginController.php](/app/Http/Controllers/KlarnaLoginController.php) file.

Add the required scopes and redirect the user

```php
public function redirectToProvider() {
  return Socialite::driver('klarna')->scopes([
    'openid', 'profile:name', 'profile:email', 'profile:phone'
  ])->redirect();
}
```

> 📕 Note: Do not forget to always add `openid` scope.

4. Handle the callback

> Follow the code in `handleCallback` function in [KlarnaLoginController.php](/app/Http/Controllers/KlarnaLoginController.php) file.

Fetch user details received from Klarna and create a user account in your database.

```php
$user = Socialite::driver('klarna')->user();
```

The fields on the user objects are as documented in [Socialiate Klarna Provider documentation](https://socialiteproviders.com/klarna/#usage).

Get the refresh token from the user object.

```php
$refreshToken = $user->refreshToken;
```


