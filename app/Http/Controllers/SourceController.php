<?php
/**
 * 资源控制器
 *      Laravel 资源路由将典型的「CRUD」路由分配给具有单行代码的控制器
 *
 *      php artisan make:controller SourceController
 *          --resource      资源控制器
 *          --model=Photo   指定资源模型
 *
 *      Route::resource('source', 'SourceController');
 *
        动作          URI	                行为	        路由名称
        GET         /photo	                index       photo.index
        GET         /photo/create	        create	    photo.create
        POST	    /photo	                store       photo.store
        GET         /photo/{photo}	        show	    photo.show
        GET         /photo/{photo}/edit	    edit	    photo.edit
        PUT/PATCH   /photo/{photo}	        update	    photo.update
        DELETE      /photo/{photo}	        destroy	    photo.destroy
 *
 * 伪造表单方法
 *      HTML 表单不能生成 PUT、 PATCH 或者 DELETE 请求，所以你需要添加一个隐藏的 _method 输入字段来伪造这些 HTTP 动作
 *      辅助函数 method_field 可以帮你创建这个字段
 *          {{ method_field('PUT') }}
 *
 * 部分资源路由
        Route::resource('photo', 'PhotoController', ['only' => [
            'index', 'show'
        ]]);

        Route::resource('photo', 'PhotoController', ['except' => [
            'create', 'store', 'update', 'destroy'
        ]]);
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Repositories\UserRepository;

class SourceController extends Controller
{
    /**
     * 本地化资源 URI
     *      默认情况下，Route::resource 将会用英文动词创建资源 URI
     *      如果需要本地化 create 和 edit 行为动作名，可以在 AppServiceProvider 的 boot 中使用 Route::resourceVerbs 方法实现
     *          注册的路由如下
     *              /source/crear
     *              /source/{source}/editar
     */
    public function boot()
    {
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);
    }

    /**
     * 依赖注入 & 控制器
     *      Laravel 使用 服务容器 来解析所有的控制器
     *      在控制器的构造函数中使用类型提示需要的依赖项，而声明的依赖项会自动解析并注入控制器实例中
     *          UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * 方法注入
     *      除了构造函数注入之外，你还可以在控制器方法中类型提示依赖项
     *          Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * 如果控制器方法需要从路由参数中获取输入内容，只需要在其他依赖项后列出路由参数即可
     *      PUT/PATCH   /source/{source}        update	    source.update
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
