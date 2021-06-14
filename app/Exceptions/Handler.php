<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException; //認証の失敗

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
    public function report(Exception $exception)
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
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
    
    /**
     * エラーで認証できなかった場合にガードを見てそれぞれのログインページへ飛ばず.
     *Laravel5.5の仕様Handler.phpの«AuthenticationException»
     *AuthenticationExceptionクラスはreportメソッドでは記録処理が行われない
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
     
    public function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        
        //guest(認証されていないuser)。routeに名前admin.loginをつけて、redirectを生成し、名前つきルートにリダイレクトしている
        if (in_array('admin', $exception->guards())) {
            return redirect()->guest(route('admin.login'));
        }
 
        return redirect()->guest(route('login'));
    }
}
