<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $URI = explode("/", $request->getRequestUri());
            switch ($URI) {
                    //管理画面が https/xxx.xxx/admin/xxxxxのケース
                case 'admin':
                    return route('admin.route');

                    //ユーザーマイページが https/xxx.xxx/mypage/xxxxxのケース
                case 'mypage':
                    return route('login');
            }
        }
    }
}