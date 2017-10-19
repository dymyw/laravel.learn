<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        return 'HelloController@index - Hello World!';

        // 重定向
//        return redirect()->route('say', ['name' => 'laravel']);
    }

    public function say($name = 'dymyw')
    {
        // 为命名路由生成链接
        $url = route('say');

        return [
            $url,
            "Hello, {$name}",
        ];
    }
}
