<?php
/**
 * 数据库
 *      Laravel 通过使用原始 SQL 与数据库的各种数据库进行交互, 非常简单。尤其流畅的使用 查询语句构造器，和 Eloquent ORM
 *      当前，Laravel 支持四种类型的数据库
 *          MySQL、Postgres、SQLite、SQL Server
 *
 * 配置信息
 *      放置在 config/database.php 文件中
 *      定义所有的数据库连接，并指定默认使用哪个连接
 *          默认情况下，Laravel 的环境配置 示例会使用 Laravel Homestead
 *
 * 读&写的分离
 *      todo
 *
 * 使用多个数据库连接
 *      todo
 *
 * 运行原生的 SQL 语句
 *      配置好数据库连接后，可以使用 DB facade 运行查询
 *      DB facade 为每种类型的查询提供了方法：select，update，insert，delete 和 statement
 *          类似于 PDO，可以使用 ? 来表示参数绑定外，还可以使用命名绑定
 *
 * 查询事件的监听
 *      todo
 *
 * 数据库事务
 *      可以在 DB facade 上使用 transaction 方法，在数据库事务中运行一组操作
 *
 *      处理死锁
 *          transaction 方法接受一个可选的第二个参数，该参数定义在发生死锁时，应该重新尝试事务的次数。一旦这些尝试都用尽了，就会抛出一个异常
 *
 *      手动操作事务
 *          DB::beginTransaction();
 *          DB::rollBack();
 *          DB::commit();
 */

/**
 * Laravel 的数据库迁移 Migrations
 *
 * 运行迁移
 *      php artisan migrate
 *
 * 回滚迁移
 *      回滚应用程序中的所有迁移
 *          php artisan migrate:reset
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // insert
//        DB::insert('insert into users(id, name, email, password) values(?, ?, ?, ?)', [1, 'Dymyw', 'dymayongwei@163.com', md5(123)]);

        // update，该方法会返回此语句执行所影响的行数
//        return $affected = DB::update('update users set name = :name where id = :id', [
//            'name' => 'Dymyw',
//            'id' => 1,
//        ]);

        // delete，该方法会返回此语句执行所影响的行数
//        return $deleted = DB::delete('delete from users');

        // select
        $user = DB::select('select * from users where id = ?', [1]);
        return $user;

        // statement，对于一些数据库语句不返回任何值的操作
//        DB::statement('drop table users');
    }
}
