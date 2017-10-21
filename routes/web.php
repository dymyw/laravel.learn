<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * ------------------------------------------------------------------------
 * Laravel HTTP 路由功能
 * ------------------------------------------------------------------------
 *
 * 路由文件
 *      所有的 Laravel 路由都在 routes 目录中的路由文件中定义，这些文件都由框架自动加载
 *      routes/web.php
 *          定义 web 界面的路由。这里面的路由都会被分配给 web 中间件组，它提供了会话状态和 CSRF 保护等功能
 *      routes/api.php
 *          路由都是无状态的，并且被分配了 api 中间件组
 *          文件中定义的路由通过 RouteServiceProvider 被嵌套到一个路由组里面，会自动添加 URL 前缀 /api 到此文件中的每个路由
 *              可以在 RouteServiceProvider 类中修改此前缀以及其他路由组选项
 *              todo
 */
// Hello World!
//Route::get('hello', function() {
//    return 'Hello World!';
//});

/**
 * 控制器方法
 *
 * 快速创建控制器
 *      php artisan make:controller HelloController
 *          --resource      资源控制器
 * 资源路由器
 *      命名资源路由 todo
 *      命名资源路由参数 todo
 *      补充资源控制器
 *          在默认的资源路由中增加额外的路由，应该在 Route::resource 之前定义这些路由
 *
 * 路由缓存
 *      基于闭包的路由不能被缓存。如果要使用路由缓存，必须将所有的闭包路由转换成控制器类路由
 *      如果你的应用只使用了基于控制器的路由，那么你应该充分利用 Laravel 的路由缓存
 *          生成路由缓存
 *              php artisan route:cache
 *              运行这个命令之后，每一次请求的时候都将会加载缓存的路由文件
 *              添加了新的路由，你需要生成 一个新的路由缓存。因此，你应该只在生产环境运行 route:cache 命令
 *
 *          清除路由缓存
 *              php artisan route:clear
 */
Route::get('hello', 'HelloController@index');
// 当一个请求与此指定路由的 URI 匹配时， TestController 类的 show 方法就会被执行。当然，路由参数也会被传递至该方法
Route::get('test/{id}', 'TestController@show');
// 子目录，自动根据命名空间加载 App\Http\Controllers\Photos\AdminController
//Route::get('foo', 'Photos\AdminController@method');
// 单个行为控制器，不需要指定方法
//Route::get('user/{id}', 'ShowProfile');
// 补充资源控制器、资源控制器
//Route::get('source/popular', 'SourceController@method');
//Route::resource('source', 'SourceController');

/**
 * 返回视图
 *      view(URL, 视图名称[, 参数数组])
 *      视图文件存放于 resources/views 目录下，「点」符号可以用来引用嵌套视图
 */
//Route::view('/hello', 'hello.hello', ['name' => 'dymyw']);

// 重定向
//Route::redirect('hello', '/');

/**
 * 可用的路由方法
 *      Route::get($uri, $callback);
 *      Route::post($uri, $callback);
 *      Route::put($uri, $callback);
 *      Route::patch($uri, $callback);
 *      Route::delete($uri, $callback);
 *      Route::options($uri, $callback);
 *
 * CSRF 保护
 *      指向 web 路由文件中定义的 POST、PUT 或 DELETE 路由的任何 HTML 表单都应该包含一个 CSRF 令牌字段，否则，这个请求将会被拒绝
 *          {{ csrf_field() }}
 *
 * 表单方法伪造
 *      HTML 表单不支持 PUT、PATCH 或 DELETE 行为
 *      需要在表单中增加隐藏的 _method 输入标签，使用 _method 字段的值作为 HTTP 的请求方法
 *          <input type="hidden" name="_method" value="PUT">
 *      也可以使用辅助函数 method_field 来生成隐藏的 _method 输入标签
 *          {{ method_field('PUT') }}
 */
// 响应多个 HTTP 请求
//Route::match(['get', 'post'], 'foo', function() {});

// 响应所有 HTTP 请求
//Route::any('foo', function() {});

/**
 * 路由参数
 *      通常都会被放在 {} 内
 *      参数名只能为字母
 *      不能包含 - 符号，可以用下划线 _ 代替
 *
 * 可选参数
 *      在参数后面加上 ? 标记来实现
 *      确保路由的相应变量有默认值
 *
 * 正则表达式约束
 *      ->where(参数名称, 定义参数应如何约束的正则表达式);
 *      ->where([参数名称 => 定义参数应如何约束的正则表达式, ...])
 *
 * 全局约束
 *      希望某个具体的路由参数都遵循同一个正则表达式的约束，就使用 pattern 方法在 RouteServiceProvider 的 boot 方法中定义这些模式
 *      todo
 */
// 路由参数
//Route::get('hello/{name}', function($name) {
//    return "Hello, {$name}";
//});

// 可选参数
//Route::get('hello/{name?}', function($name = 'dymyw') {
//    return "Hello, {$name}";
//});

/**
 * 命名路由
 *      在路由定义上链式调用 name 方法指定路由名称
 *
 * 用处
 *      使用全局辅助函数 route 来生成链接或者重定向到该路由
 *
 * 检查当前路由
 *      判断当前请求是否指向了某个路由，你可以调用路由实例上的 named 方法
 *      todo
 */
//Route::get('hello/say/{name?}', 'HelloController@say')->name('say');

/**
 * 路由组
 *      在大量路由之间共享路由属性，例如中间件或命名空间
 *
 * 中间件
 *      在 group 之前调用 middleware 方法.中间件会依照它们在数组中列出的顺序来运行
 *      通过一个 : 来隔开中间件名称和参数来指定中间件参数。多个参数就使用逗号分隔
 *
 * 命名空间
 *      请记住，默认情况下，RouteServiceProvider 会在命名空间组中引入你的路由文件，让你不用指定完整的 App\Http\Controllers 命名空间前缀就能注册控制器路由
 *      只需要指定命名空间 App\Http\Controllers 之后的部分
 *
 * 子域名
 *      在 group 之前调用 domain 方法来指定子域名
 *      子域名可以像路由 URI 一样被分配路由参数，允许你获取一部分子域名作为参数给路由或控制器使用
 *
 * 路由前缀
 *      可以用 prefix 方法为路由组中给定的 URL 增加前缀
 */
// 中间件
//Route::middleware(['test']) // 多个
////Route::middleware('test') // 一个
//    ->group(function() {
//    Route::get('user/age/{age}', function($age) {
//        return $age + 10;
//    });
//});

////use App\Http\Middleware\TestMiddleware;
//Route::get('user/age/{age}', function($age) {
//    return $age + 10;
//})
//    ->middleware('test');
////  ->middleware('first', 'second'); // 多个中间件
////  ->middleware(TestMiddleware::class); // 可以传递完整的类名，需要 use App\Http\Middleware\TestMiddleware;

// 命名空间
//Route::namespace('Admin')->group(function() {
//    // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
//});

// 子域名
//Route::domain('{account}.myapp.com')->group(function() {
//    Route::get('user/{id}', function($account, $id) {});
//});

// 路由前缀
//Route::prefix('admin')->group(function() {
//    Route::get('users', function() {
//        // 匹配包含 "/admin/users" 的 URL
//    });
//});

// group
Route::group(['middleware' => ['test:30,40'], 'prefix' => 'age'], function() {
    Route::get('{age}', function($age) {
        return $age + 10;
    });
});

/**
 * 路由模型绑定
 *      Eloquent 模型
 *      todo
 */

/**
 * 访问当前路由
 *      Facade
 *      todo
 */
//$route = Route::current();
//$name = Route::currentRouteName();
//$action = Route::currentRouteAction();
