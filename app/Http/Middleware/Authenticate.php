<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $admin_route = 'admin.login';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if (! $request->expectsJson()) {

            if (Route::is('admin.*')) {
                return route($this->admin_route);
            }
            return route('login');
        }

                // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
                // if (!$request->expectsJson()) {
                //     if (Route::is('user.*')) {
                //         return route($this->user_route);
                //     } elseif (Route::is('admin.*')) {
                //         return route($this->admin_route);
                //     }
                // }


    }
}
