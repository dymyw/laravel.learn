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
use Illuminate\Support\Facades\URL;

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

    /**
     * Laravel 的 URL 生成
     *      Laravel 提供了几个辅助函数来为应用程序生成 URL
     *      主要用于在模板和 API 响应中构建 URL 或者在应用程序的其他部分生成重定向响应
     *
     * 生成基础 URL
     *      辅助函数 url 可以用于应用的任何一个 URL
     *      todo
     *
     * 访问当前 URL
     *      如果没有给辅助函数 url 提供路径，则会返回一个 Illuminate\Routing\UrlGenerator 实例，来允许你访问有关当前 URL 的信息
     *          url()->current(); // $request->url();
     *          url()->full(); // $request->fullUrl();
     *          url()->previous();
     *      也都可以通过 URL facade 访问
     *          use Illuminate\Support\Facades\URL;
     *          URL::current();
     *          URL::full();
     *          URL::previous();
     *
     * 命名路由的 URL
     *      辅助函数 route 可以用于为指定路由生成 URL
     *          route('say', ['name' => 'dymyw']);
     *      将 Eloquent 模型 作为参数值传给 route 方法，它会自动提取模型的主键来生成 URL
     *          todo
     *
     * 控制器行为的 URL
     *      action 功能可以为给定的控制器行为生成 URL
     *      这个功能不需要你传递控制器的完整命名空间，但你需要传递相对于命名空间 App\Http\Controllers 的控制器类名
     *          $url = action('HelloController@say');
     *      如果控制器方法需要路由参数，那就将它们作为第二个参数传递给 action 函数
     *          $url = action('HelloController@say', ['name' => 'dymyw']);
     *
     * 默认值
     *      使用 URL::defaults 方法定义这个参数的默认值
     *      从 路由中间件 调用此方法来访问当前请求
     *          URL::defaults(['name' => 'dymyw']);
     *          todo
     */
    public function url()
    {
        echo $url = action('HelloController@say', ['name' => 'dymyw']);
    }
}
