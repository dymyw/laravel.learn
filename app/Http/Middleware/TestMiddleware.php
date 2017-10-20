<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Laravel 的路由中间件
 *      Laravel 中间件提供了一种方便的机制来过滤进入应用的 HTTP 请求
 *      Laravel 自带了一些中间件，包括身份验证、CSRF 保护等。所有这些中间件都位于 app/Http/Middleware 目录
 *
 *      将中间件想象为一系列 HTTP 请求必须经过才能触发你应用的「层」
 *      每一层都会检查请求（是否符合某些条件）
 *      （如果不符合）甚至可以（在请求访问你的应用之前）完全拒绝掉
 *
 * 定义中间件
 *      php artisan make:middleware TestMiddleware
 */
class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  integer $from
     * @param  integer $to
     * @return mixed
     */
    public function handle($request, Closure $next, $from, $to)
    {
        // 前置中间件：在应用处理请求 之前 执行
        if ($request->age < $from || $request->route('age') > $to) {
            return redirect('/');
        }

        $response = $next($request);

        // 后置中间件：在应用处理请求 之后 执行
//        var_dump($response);
//        if ($response->original > 31) {
//            return redirect('/');
//        }

        return $response;
    }
}
