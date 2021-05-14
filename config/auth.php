<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'user',// マルチ認証の設定でwebからuserに変更
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',//driverはguardの名前
            'provider' => 'users',
        ],
 
        'api' => [
            'driver' => 'token',//ログイン認証の方式tの一つoken(おくされてきたtokenの検証のみ)
            'provider' => 'users',
        ],
        'user' => [
            'driver' => 'session',//ログイン認証の方式tの一つsession(情報が保持される)
            'provider' => 'users',
        ],
        'admin' => [ //マルチ認証の設定
            'driver' => 'session', //マルチ認証の設定
            'provider' => 'admins', //マルチ認証の設定
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

   'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
        'admins' => [ //マルチ認証の設定
            'driver' => 'eloquent', //マルチ認証の設定
            'model' => App\Admin::class, //マルチ認証の設定
        ],
 
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],
 

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

        'admins' => [ //マルチ認証の設定
        'provider' => 'admins', //マルチ認証の設定
        'table' => 'password_resets', //マルチ認証の設定
        'expire' => 60, //マルチ認証の設定
    ],

];
