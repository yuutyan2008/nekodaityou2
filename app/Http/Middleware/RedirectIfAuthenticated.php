<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

//ログイン後にログインした時のリダイレクト先の指定
class RedirectIfAuthenticated //RedirectIfAuthenticatedは認証処理用のミドルウェア
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next(クラスを利用した型宣言)
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        //SessionGuardのcheckメソッド実行で認証チェック
        if (Auth::guard($guard)->check()) {
            if (strcmp($guard, 'admin') == 0) {
                return redirect('/admin/home');//strcmpで文字列を比較し、0は一致している場合(管理者認証が既に終わっている)
            }
            return redirect('/home');//それ以外の場合はhomeへ
        }
        
        // 認証が未完了の場合、次のmiddleware処理のために$nextへ$requestが渡される
        return $next($request);
    }
}
