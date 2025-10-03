<?php

namespace App\Providers;

// viewレンダリング時にcontrollerを介さず、処理を自動実行する(ビューコンポーザ)
// ビューコンポーザが自動処理したレンダリングページを、コントローラに組み込み、アプリで使えるようにする
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // HTTP通信プロトコルをHTTPSに変更
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }

        // 管理画面レイアウトで共有したいログイン中の管理者情報を注入
        // functionがクロージャ(関数)、$viewがクロージャに渡す引数
        // $viewはView名前空間にあるViewクラスのインスタンスで、ビューを管理する
        View::composer('layouts.app_admin', function ($view) {
            // レンダリング時にテンプレートに変数を渡す
            // with(変数名、値)はビューに変数を追加する
            //
            $view->with('adminUser', Auth::guard('admin')->user());
        });
    }
}
