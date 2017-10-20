<?php

namespace App\Http\Middleware;

use Closure;

class TestTerminateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Terminable 中间件
     *      在 HTTP 响应发送到浏览器之后处理一些工作
     *      在中间件中定义一个 terminate 方法，则会在响应发送到浏览器后自动调用
     *      一旦定义了这个中间件，你应该将它添加到路由列表或 app/Http/Kernel.php 文件的全局中间件中
     *      todo
     */
    public function terminate($request, $response)
    {
        // Store the session data...

        var_dump('terminate middleware');
    }
}
