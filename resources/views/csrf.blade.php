<?php
/**
 * 跨站请求伪造是一种恶意的攻击，它凭借已通过身份验证的用户身份来运行未经过授权的命令
 *
 * Laravel 下的伪造跨站请求保护 CSRF
 *      Laravel 会自动为每个活跃用户的会话生成一个 CSRF「令牌」
 *      该令牌用于验证经过身份验证的用户是否是向应用程序发出请求的用户
 *
 * 任何情况下当你在应用程序中定义 HTML 表单时，都应该在表单中包含一个隐藏的 CSRF 令牌字段，以便 CSRF 保护中间件可以验证该请求
 *      可以使用辅助函数 csrf_field 来生成令牌字段
 *          {{ csrf_field() }}
 *      包含在 web 中间件组里的 VerifyCsrfToken 中间件会自动验证请求里的令牌是否与存储在会话中令牌匹配
 *
 * CSRF 令牌 & JavaScript
 * todo
 *
 * CSRF 白名单
 *      把这类路由放到 routes/web.php 外，因为 RouteServiceProvider 的 web 中间件适用于该文件中的所有路由
 *      也可以通过将这类 URI 添加到 VerifyCsrfToken 中间件中的 $except 属性来排除对这类路由的 CSRF 保护
 *          App\Http\Middleware\VerifyCsrfToken.php
 *      todo
 *
 * X-CSRF-TOKEN
 *      除了检查 POST 参数中的 CSRF 令牌外，VerifyCsrfToken 中间件还会检查 X-CSRF-TOKEN 请求头
 *      可以将令牌保存在 HTML meta 标签中
 *          <meta name="csrf-token" content="{{ csrf_token() }}">
 *      可以使用类似 jQuery 的库自动将令牌添加到所有请求的头信息中
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content');
                }
            });
 *      todo
 *
 * X-XSRF-TOKEN
 *      Laravel 将当前的 CSRF 令牌存储在由框架生成的每个响应中包含的一个 XSRF-TOKEN cookie 中
 *      可以使用 cookie 值来设置 X-XSRF-TOKEN 请求头
 *      而一些 JavaScript 框架和库（如 Angular 和 Axios）会自动将这个值添加到 X-XSRF-TOKEN 头中
 *      todo
 */
