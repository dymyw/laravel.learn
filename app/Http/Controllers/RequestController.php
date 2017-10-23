<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Laravel 的 HTTP 请求
     *
     * 要通过依赖注入的方式来获取当前 HTTP 请求的实例
     *      Request $request
     *
     * Illuminate\Http\Request 实例提供了多种方法来检查应用程序的 HTTP 请求
     *      继承了 Symfony\Component\HttpFoundation\Request 类
     *
     * PSR-7 请求
     *      todo
     *
     * 输入预处理 & 规范化
     *      默认情况下，Laravel 在应用程序的全局中间件堆栈中包含了 TrimStrings 和 ConvertEmptyStringsToNull 两个中间件
     *      这些中间件由 App\Http\Kernel 类列在堆栈中
     *      它们会自动处理请求上所有传入的字符串字段，并将空的字符串字段转变成 null 值
     */
    public function show(Request $request, $id)
    {
//        return "Show: {$id}";

        /**
         * fullUrl 方法，获取传入请求的完整 URL，包含查询字符串 With Query String...
         *      http://laravel.learn/request/111?name=dymyw
         *          => http://laravel.learn/request/111?name=dymyw
         *
         * url 方法，获取传入请求的完整 URL，不包含查询字符串 Without Query String...
         *      http://laravel.learn/request/111?name=dymyw
         *          => http://laravel.learn/request/111
         *
         * path 方法，获取请求路径
         *      http://laravel.learn/request/111?name=dymyw
         *          => request/111
         *
         * is 方法，验证传入的请求路径和指定规则是否匹配
         *      可以传递一个 * 字符作为通配符
         *
         * method 方法，获取 HTTP 的请求方式
         *      大写
         * isMethod 方法，验证 HTTP 的请求方式与指定规则是否相配
         *      不区分大小写
         *
         * all 方法，获取所有输入数据
         *      http://laravel.learn/request/111?name=dymyw
         *          => ['name' => 'dymyw']
         *
         * input 方法，获取指定输入值，无论是什么样的 HTTP 动作都适用，包括查询字符串
         *      第二个参数传入默认值
         *          $name = $request->input('name', 'dymyw');
         *      传输表单数据中包含「数组」形式的数据，那么可以使用「点」语法来获取数组
         *          $name = $request->input('products.0.name');
         *          $names = $request->input('products.*.name');
         *      获取 JSON 输入信息
         *          发送到应用程序的请求数据是 JSON，只要请求的 Content-Type 标头正确设置为 application/json
         *          可以通过 Input 方法访问 JSON 数据。你甚至可以使用 「点」语法来读取 JSON 数组
         *
         * query 方法，从查询字符串中获取数据
         *      $name = $request->query('name');
         *      $name = $request->query('name', 'Helen');
         *      检索所有查询字符串值，返回关联数组
         *          $query = $request->query();
         *
         * 通过动态属性获取输入
         *      Laravel 在处理动态属性的优先级是，先在请求的数据中查找，如果没有，再到路由参数中查找
         *      http://laravel.learn/request/111?name=dymyw
         *          return $request->name; // dymyw
         *          return $request->id; // 111
         *
         * only 方法、except 方法，获取输入数据的子集（关联数组）
         *      这两个方法都接收 数组 或动态列表作为参数
         *          $input = $request->only(['username', 'password']);
         *          $input = $request->only('username', 'password');
         *          $input = $request->except(['credit_card']);
         *          $input = $request->except('credit_card');
         *
         * has 方法，判断请求是否存在某个值（isset）
         *      当提供一个数组作为参数时，has 方法将确定是否存在数组中 所有 给定的值
         *
         * filled 方法，是否存在值并且不为空（!empty）
         */
//        return $url = $request->fullUrl();

//        return $url = $request->url();

//        return $uri = $request->path();

//        if ($request->is('request/*')) {
//            return 'Yes';
//        } else {
//            return 'No';
//        }

//        return $method = $request->method();
//        if ($request->isMethod('get')) {
//            return 'Yes';
//        } else {
//            return 'No';
//        }

//        return $input = $request->all();

        /**
         * 旧输入
         *      Laravel 允许你将本次请求的数据保留到下一次请求发送前
         *      使用了 Laravel 的 验证功能，你就不需要在手动实现这些方法，因为 Laravel 内置的验证工具会自动调用他们
         *
         * flash 方法，将输入闪存至 Session
         *      $request->flash();
         *
         * flashOnly 方法、flashExcept 方法，将请求数据的一部分闪存到 session。这些方法对敏感信息（例如密码）的保护非常有用
         *      $request->flashOnly(['username', 'email']);
         *      $request->flashExcept('password');
         *
         * 闪存输入后重定向 redirect
         *      return redirect('form')->withInput();
         *      return redirect('form')->withInput(
                    $request->except('password')
                );
         *
         * old 方法，从 Session 取出之前被闪存的输入数据
         *      $username = $request->old('username');
         *      Laravel 也提供了全局辅助函数 old，在 Blade 模板 中显示旧的输入，使用 old 会更加方便。给定字段没有旧的输入，则返回 null
         *          <input type="text" name="username" value="{{ old('username') }}">
         */

        /**
         * Cookies
         *      Laravel 框架创建的每个 cookie 都会被加密并使用验证码进行签名，这意味着如果客户端更改了它们，便视为无效
         *
         * cookie 方法，获取 cookie 值
         *      $value = $request->cookie('name');
         *
         * 将 Cookies 附加到响应 response
         *      return response('Hello World')->cookie(
                    'name', 'value', $minutes[, $path, $domain, $secure, $httpOnly]
                );
         *
         * 生成 Cookie 实例
         *      $cookie = cookie('name', 'value', $minutes);
         *      return response('Hello World')->cookie($cookie);
         */

        /**
         * file 方法，获取上传文件
         *      该 file 方法返回一个 Illuminate\Http\UploadedFile 类的实例，该类继承了PHP 的 SplFileInfo 类的同时也提供了各种与文件交互的方法
         *      $file = $request->file('photo');
         *      $file = $request->photo;
         *
         * hasFile 方法，判断请求中是否存在文件
         *      if ($request->hasFile('photo')) {}
         *
         * isValid 方法，验证上传的文件是否有效
         *      if ($request->file('photo')->isValid()) {}
         *
         * 文件路径 & 扩展名
         *      $path = $request->photo->path();
         *      $extension = $request->photo->extension();
         *
         * 存储上传文件
         *      先配置好 文件系统
         *      使用 UploadedFile 的 store 方法把上传文件移动到你的某个磁盘上，该文件可能是本地文件系统中的一个位置，甚至像 Amazon S3 这样的云存储位置
         *          store 方法接受 相对于 文件系统配置的存储文件根目录的路径。这个路径不能包含文件名，因为系统会自动生成唯一的 ID 作为文件名
         *              还接受可选的第二个参数，用于存储文件的磁盘名称。这个方法会返回相对于磁盘根目录的文件路径
         *              $path = $request->photo->store('images');
         *              $path = $request->photo->store('images', 's3');
         *          storeAs 方法，它接受路径、文件名和磁盘名作为其参数，指定文件名
         *              $path = $request->photo->storeAs('images', 'filename.jpg');
         *              $path = $request->photo->storeAs('images', 'filename.jpg', 's3');
         */

        /**
         * 配置可信代理
         *      todo
         */
    }
}
