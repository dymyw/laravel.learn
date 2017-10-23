<?php
/**
 * Laravel 的视图
 *
 * 视图包含应用程序的 HTML，并且将控制器／应用程序逻辑与演示逻辑分开
 *      视图文件存放于 resources/views 目录下，「点」符号可以用来引用嵌套视图
 *
 * 判断视图是否存在
 *      use Illuminate\Support\Facades\View;
 *      if (View::exists('emails.customer')) {}
 *
 * 向视图传递数据
 *      传递数组
 *          view('blade', ['name' => 'dymyw']);
 *      with 方法将单个数据片段添加到视图
 *          view('blade')->with('name', 'dymyw');
 *
 * 与所有视图共享数据
 *      在服务提供器的 boot 方法中调用视图 Facade 的 share 方法
 *          app/Providers/AppServiceProvider.php
 *          或者为它们生成一个单独的服务提供器
 *
 * 视图合成器
 *      todo
 */
?>

<html>
    <body>
        <h1>Hello, {{ $Frame }}</h1>
        <h1>Hello, {{ $name }}</h1>
        <h1>Hello, <?=$name?></h1>
    </body>
</html>
