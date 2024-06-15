<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException; //認証の失敗

// use app\Http\Middleware\Authenticate;//マルチ認証5.8で追加

// handlerクラスは、発生するエラーや例外をキャッチしてuserへ表示
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *レポートしない例外リスト
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.例外のログまたは報告
     *reportはhandlerクラスのメソッド
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        
        //継承した親クラスのreportメソッドを呼び出す
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.例外をブラウザへ送り返すため、HTTPに変換する
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
    
    /**
     * エラーで認証できなかった場合にガードを見てそれぞれのログインページへ飛ばず.
     *Laravel5.5の仕様Handler.phpの«AuthenticationException»
     *AuthenticationExceptionクラスはreportメソッドでは記録処理が行われない
     * config/auth.phpで指定したadminのguard
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
     
    public function unauthenticated($request, AuthenticationException $exception)
    {
        
        //（requestがwebかAPIかをLaravelが判定し）APIリクエストでエラーが起きた時はJSONで帰ってくるよう設定（Laravel５.７以後は自動設定されるため不要）
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        
        logger('admin');
        /**
         *guest(認証されていないuser)。routeに名前admin.loginをつけて、redirectを生成し、名前つきルートにリダイレクトしている
         * adminユーザー入力の中にexceptionがあれば、guardメソッドを呼び出し
         *$guardはadminというguard名の配列
         */
        if (in_array('admin', $exception->guards())) {
            return redirect()->guest(route('admin.login'));
        }
 
        return redirect()->guest(route('login'));
    }
}
