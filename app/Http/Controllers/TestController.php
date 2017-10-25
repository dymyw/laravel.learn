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
use Illuminate\Support\Facades\Log;

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

    /**
     * Laravel 的 HTTP 会话机制
     *      由于 HTTP 驱动的应用程序是无状态的，Session 提供了一种在多个请求之间存储有关用户的信息的方法
     *      Laravel 通过同一个可读性强的 API 处理各种自带的 Session 后台驱动程序
     *          支持诸如比较热门的 Memcached、Redis 和开箱即用的数据库等常见的后台驱动程序
     *
     * 配置
     *      Session 的配置文件存储在 config/session.php
     *          driver 的配置选项定义了每个请求存储 Session 数据的位置
     *              file - 将 Session 保存在 storage/framework/sessions 中
     *              cookie - Session 保存在安全加密的 Cookie 中
     *              database - Session 保存在关系型数据库中
     *              memcached / redis - Sessions 保存在其中一个快速且基于缓存的存储系统中
     *              array - Sessions 保存在 PHP 数组中，不会被持久化
     *                  一般用于 测试，并防止存储在 Session 中的数据被持久化
     *
     * 驱动之前
     *      数据库
     *          todo
     *      Redis
     *          Laravel 在使用 Redis 作为 Session 驱动之前，需要通过 Composer 安装 predis/predis 扩展包 (~1.0)
     *          在 database 配置文件中配置 Redis 连接信息
     *          在 session 配置文件中，connection 选项可用于指定 Session 使用哪个 Redis 连接
     *          todo
     *
     * 使用 Session
     *      通过 HTTP 请求实例操作 Session 与使用全局辅助函数 session 两者之间并没有实质上的区别
     *      这两种方法都可以通过所有测试用例中可用的 assertSessionHas 方法进行 测试
     *          session 全局辅助函数
     *              session(['login_user' => 'dymyw']);
     *              $value = session('login_user', 'default');
     *          Request 实例来访问 session
     *              $request->session()->get('aaa', 'default');
     *              $request->session()->get('aaa', function() {
                        return 'ccc';
                    });
     *
     *          获取所有 Session 数据
     *              $data = $request->session()->all();
     *
     *          判断 Session 中是否存在某个值，该值存在且不为 null
     *              if ($request->session()->has('aaa')) {};
     *          判断 Session 中是否存在某个值，即使其值为 null
     *              if ($request->session()->exists('aaa')) {};
     *
     *          存储数据
     *              // 保存到字符串
     *              $request->session()->put('bbb', 'b');
     *              // 保存到数组
     *              $request->session()->push('user.teams', 'developers');
     *
     *          检索 & 删除
     *              $value = $request->session()->pull('key', 'default');
     *              // 删除
     *              $request->session()->forget('aaa');
     *              // 删除全部
     *              $request->session()->flush();
     *
     *          闪存数据
     *              在下一个请求之前在 Session 中存入数据，可以使用 flash 方法
     *              闪存数据主要用于短期的状态消息
     *                  $request->session()->flash('status', 'Task was successful!');
     *              保留闪存数据给更多请求，可以使用 reflash 方法，只想保留特定的闪存数据，则可以使用 keep 方法
     *                  $request->session()->reflash();
     *                  $request->session()->keep(['username', 'email']);
     *
     *          重新生成 Session ID
     *              $request->session()->regenerate();
     *
     * 添加自定义 Session 驱动
     *      todo
     */
    public function session(Request $request)
    {
        return $request->session()->all();
    }

    /**
     * Laravel 的错误和日志记录
     *      Laravel 默认自带错误和异常处理机制
     *          应用程序触发的所有异常都被 App\Exceptions\Handler 类记录下来，然后渲染给用户
     *      Laravel 使用 Monolog 库为各种强大的日志处理程序提供支持
     *          Laravel 配置了多种日志处理程序，方便你在单个日志文件、多个日志文件或将错误信息写入系统日志之间进行选择
     *
     * 配置
     *      错误的详细信息
     *          config/app.php 配置文件的 debug 选项决定了是否向用户显示错误信息
     *          默认情况下，此选项设置为获取存储在 .env 文件中的 APP_DEBUG 环境变量的值
     *              APP_ENV=local           APP_DEBUG=true
     *              APP_ENV=production      APP_DEBUG=false
     *              'env' => env('APP_ENV', 'production'),
     *              'debug' => env('APP_DEBUG', false),
     *
     *      日志存储
     *          Laravel 支持 single 、daily 、 syslog 和 errorlog 四种日志写入模式
     *          修改 config/app.php 配置文件中的 log 选项来配置 Laravel 使用的存储机制
     *              'log' => 'daily',
     *
     *      最大日志文件数
     *          使用 daily 日志模式时，Laravel 默认只保留五天份的日志文件
     *              'log_max_files' => 30,
     *
     *      日志严重程度级别
     *          使用 Monolog 时，日志消息可能具有不同程度的严重级别。默认情况下，Laravel 将存储所有级别的日志
     *          通过将 log_level 选项添加到 app.php 配置文件中来配置应当记录的严重程度最低的日志级别
     *          默认的 log_level 被设置为 error
     *              'log_level' => env('APP_LOG_LEVEL', 'error'),
     *          Monolog 识别以下严重程度的级别，从低到高为: debug、info、notice、warning、error、critical、alert、emergency
     *
     * 自定义 Monolog 配置
     *      todo
     * 自定义渠道名称
     *      todo
     *
     * 异常处理
     *      todo
     *
     * HTTP 异常
     *      辅助函数 abort 会创建一个由异常处理程序渲染的异常。此外，还可以提供响应文本
     *          abort(403, 'Unauthorized action.');
     *
     *      自定义 HTTP 错误页面
     *          自定义 404 HTTP 状态代码的错误页面，就创建一个 resources/views/errors/404.blade.php
     *          由 abort 函数引发的 HttpException 实例将作为 $exception 变量传递给视图
     *              <h2>{{ $exception->getMessage() }}</h2>
     *
     * 日志
     *      Laravel 在强大的 Monolog 库上提供了一个简单的抽象层。默认情况下，Laravel 的日志文件的存储目录被配置为 storage/logs
     *      可以使用 Log facade 将信息写入日志，默认文件名为 laravel.log
     *      日志记录器提供 RFC 5424 中定义的八种日志级别：emergency、alert、critical、error、warning、notice、info 和 debug
     *          // [2017-10-25 09:18:21] local.INFO: Showing user profile for user: dymyw
     *          Log::info('Showing user profile for user: ' . $name);
     *
     *      上下文信息
     *          上下文数据也可以用数组的形式传递给日志方法。此上下文数据将被格式化并与日志消息一起显示
     *              // [2017-10-25 09:18:21] local.INFO: Showing user profile for user {"name":"dymyw"}
     *              Log::info('Showing user profile for user', ['name' => $name]);
     *
     *      访问底层的 Monolog 实例
     *          $monolog = Log::getMonolog();
     *          todo
     */
    public function log($name = 'dymyw')
    {
        // HTTP 异常
        abort(403, 'Unauthorized action.');
    }
}
