<?php
/**
 * Laravel 的 HTTP 控制器
 *      控制器能够将相关的请求处理逻辑组成一个单独的类
 *      控制器被存放在 app/Http/Controllers 目录下
 *
 * 控制器与命名空间
 *      在定义控制器路由时，不需要指定完整的控制器命名空间
 *      RouteServiceProvider 会在一个包含命名空间的路由器组中加载路由文件，所以只需要指定类名中 App\Http\Controllers 命名空间之后的部分就可以了
 *
 * 单个行为控制器
 *      在控制器中放置一个 __invoke 方法
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 控制器并不是一定要继承基础类
 *      但是，如果控制器没有继承基础类，你将无法使用一些便捷的功能，比如 middleware、validate 和 dispatch 方法
 *          middleware 用来给控制器行为添加中间件
 */
class TestController extends Controller
{
    public function __construct()
    {
        /**
         * 控制器中间件
         *      使用控制器构造函数中的 middleware 方法，你可以很容易地将中间件分配给控制器的行为
         *      可以约束中间件只对控制器类中的某些特定方法生效
         */
//        $this->middleware('auth');

//        $this->middleware('log')->only('index');

//        $this->middleware('subscribed')->except('store');

        // 使用闭包来为控制器注册中间件 todo
//        $this->middleware(function($request, $next) {
//            // ...
//
//            return $next($request);
//        });
    }

    public function show($id)
    {
        return "Show: {$id}";
    }
}
