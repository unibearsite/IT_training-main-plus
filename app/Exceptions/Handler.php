<?php

namespace App\Exceptions;

use App\Exceptions\InvalidOrderException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        
    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->expectsJson()){
            return response()->json(['message' => $exception->getMessage()], 401);
        }
 
        if (in_array('admin', $exception->guards())) {
            return redirect()->guest(route('admin.login'));
        }
 
        return redirect()->guest(route('login'));
    }

    public function render($request, \Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return redirect(route('login'));
        }
        return parent::render($request, $exception);
    }
}
