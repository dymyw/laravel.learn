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
//        $user = DB::select('select * from users where id = ?', [1]);
//        return $user;

        // statement，对于一些数据库语句不返回任何值的操作
//        DB::statement('drop table users');

        /**
         * ------------------------------------------------------------------------
         * Laravel 数据库之：数据库请求构建器
         * ------------------------------------------------------------------------
         *      Laravel 的数据库查询构造器提供了一个方便、流畅的接口，用来创建及运行数据库查询语句
         *      它能用来执行应用程序中的大部分数据库操作，且能在所有被支持的数据库系统中使用
         *      Laravel 的查询构造器使用 PDO 参数绑定，来保护你的应用程序免受 SQL 注入的攻击
         *
         * 获取结果
         *      table 方法针对查询表返回一个查询构造器实例，允许你在查询时链式调用更多约束
         *          DB::table('users')
         *
         *      get 方法会返回一个 Illuminate\Support\Collection 结果，每个结果都是一个 PHP StdClass 对象的实例
         *          DB::table('users')->get()
         *
         *      first 方法从数据表中获取一行数据
         *          DB::table('users')->where('name', 'Dymyw')->first()
         *
         *      value 方法来从单条记录中取出单个值
         *          DB::table('users')->where('name', 'Dymyw')->value('email')
         *
         *      pluck 方法获取一个包含单个字段值的集合，column
         *          DB::table('users')->pluck('name')
         *          DB::table('users')->pluck('email', 'name')
         *
         *      chunk 方法结果分块，每次只取出一小块结果，并会将每个块传递给一个 闭包 处理
         *          从 闭包 中返回 false，以停止对后续分块的处理
         *          需要配合 orderBy 一起使用
         *
         *      聚合
         *          count、 max、 min、 avg 和 sum
         *              $userCount = DB::table('users')->count();
         *              $price = DB::table('orders')->max('price');
         *
         * Selects
         *      select 方法来查询指定的字段
         *          DB::table('users')->select('name', 'email as user_email')->get()
         *      addSelect 方法允许已有一个查询构造器实例，在现有的 select 子句中加入一个字段
         *          $query = DB::table('users')->select('name');
         *          $users = $query->addSelect('email')->get();
         *
         *      distinct 方法允许你强制让查询返回不重复的结果
         *
         *      DB::raw 方法，创建一个原始表达式要小心避免造成 SQL 注入攻击！
         *
         * Joins
         *      Inner Join 语法
         *          ->join('contacts', 'users.id', '=', 'contacts.user_id')
         *
         *      Left Join 语法
         *          ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
         *
         *      Cross Join 语法，交叉连接通过第一个表和连接表生成一个笛卡尔积
         *          ->crossJoin('colours')
         *
         *      高级 Join 语法
         *          todo
         *
         * Unions
         *      先创建一个初始查询，并使用 union 方法将它与第二个查询进行合并
         *
         * Where 子句
         *      where 方法需要3个参数。第一个参数是字段的名称。第二个参数是运算符，它可以是数据库所支持的任何运算符。最后，第三个参数是要对字段进行评估的值
         *          $users = DB::table('users')->where('name', '=', 'Dymyw')->get();
         *          ->where('name', 'like', 'T%')
         *          简单的校验某个字段等于一个指定的值，你可以直接将这个值作为第二个参数传入
         *              $users = DB::table('users')->where('name', 'Dymyw')->get();
         *          可以通过一个条件数组做 where 的查询
         *              $users = DB::table('users')->where([
                            ['id', '=', '1'],
                            ['name', '<>', 'Dymyw'],
                        ])->get();
         *
         * Or 语法
         *      orWhere 方法接收和 where 方法相同的参数
         *          ->orWhere('name', 'John')
         *
         * whereBetween 方法用来验证字段的值介于两个值之间
         *      ->whereBetween('votes', [1, 100])
         * whereNotBetween 方法验证字段的值 不 在两个值之间
         *      ->whereNotBetween('votes', [1, 100])
         *
         * whereIn 方法验证字段的值包含在指定的数组内
         *      ->whereIn('id', [1, 2, 3])
         * whereNotIn 方法验证字段的值 不 包含在指定的数组内
         *      ->whereNotIn('id', [1, 2, 3])
         *
         * whereNull 方法验证字段的值为 NULL
         *      ->whereNull('updated_at')
         * whereNotNull 方法验证字段的值 不 为 NULL
         *      ->whereNotNull('updated_at')
         *
         * whereDate 方法比较某字段的值与指定的日期是否相等
         *      ->whereDate('created_at', '2016-12-31')
         * whereMonth 方法比较某字段的值是否与一年的某一个月份相等
         *      ->whereMonth('created_at', '12')
         * whereDay 方法比较某列的值是否与一月中的某一天相等
         *      ->whereDay('created_at', '31')
         * whereYear 方法比较某列的值是否与指定的年份相等
         *      ->whereYear('created_at', '2016')
         *
         * whereColumn 方法用来检测两个列的数据是否一致
         *      ->whereColumn('first_name', 'last_name')
         *      ->whereColumn('updated_at', '>', 'created_at')
         *      whereColumn 方法可以接收数组参数。条件语句会使用 and 连接起来
         *          ->whereColumn([
                        ['first_name', '=', 'last_name'],
                        ['updated_at', '>', 'created_at']
                    ])
         *
         * 参数分组
         *      创建更高级的 where 子句，在括号中将约束分组
         *          DB::table('users')
                        ->where('name', '=', 'John')
                        ->orWhere(function ($query) {
                            $query->where('votes', '>', 100)
                                  ->where('title', '<>', 'Admin');
                            })
                        ->get();
         *          select * from users where name = 'John' or (votes > 100 and title <> 'Admin')
         *
         * Where Exists 语法
         *      todo
         *
         * JSON 查询语句
         *      Laravel 也支持查询 JSON 类型的字段。目前，本特性仅支持 MySQL 5.7+ 和 Postgres数据库
         *      todo
         *
         * orderBy 方法允许你根据指定字段对查询结果进行排序 asc | desc
         *      ->orderBy('name', 'desc')
         *
         * latest 和 oldest 方法允许你更容易的依据日期对查询结果排序。默认查询结果将依据 created_at 列，也可以使用字段名称排序
         *      DB::table('users')->latest()->first();
         *      DB::table('users')->latest('id')->first();
         *
         * inRandomOrder 方法可以将查询结果随机排序
         *      DB::table('users')->inRandomOrder()->first();
         *
         * groupBy 和 having 方法可用来对查询结果进行分组。having 方法的用法和 where 方法类似
         *      DB::table('users')
                    ->groupBy('account_id')
                    ->having('account_id', '>', 100)
                    ->get();
         * havingRaw 方法可以将一个原始的表达式设置为 having 子句的值
         *      ->havingRaw('SUM(price) > 2500')
         *
         * limit 和 offset 方法
         *      DB::table('users')
                    ->offset(10)
                    ->limit(5)
                    ->get();
         *
         * 条件语句
         *      根据不同的条件，组合不同的 SQL 进行查询
         *      当 when 方法的第一个参数为 true 时，第一个 闭包 执行，如果第一个参数的值为 false 时，第二个 闭包 执行
         *          $sortBy = null;

                    $users = DB::table('users')
                                ->when($sortBy, function ($query) use ($sortBy) {
                                        return $query->orderBy($sortBy);
                                    }, function ($query) {
                                        return $query->orderBy('name');
                                    })
                                ->get();
         *
         * Inserts
         *      insert 方法，用来插入记录到数据表中。insert 方法接收一个包含字段名和值的数组作为参数
         *          DB::table('users')->insert(
                        ['email' => 'john@example.com', 'votes' => 0]
                    );
         *          插入多条记录，每个数组表示要插入表中的行
         *              DB::table('users')->insert([
                            ['email' => 'taylor@example.com', 'votes' => 0],
                            ['email' => 'dayle@example.com', 'votes' => 0]
                        ]);
         *
         *      insertGetId 方法来插入记录并获取其 ID
         *          $id = DB::table('users')->insertGetId(
                        ['email' => 'john@example.com', 'votes' => 0]
                    );
         *
         * Updates
         *      update 来更新已存在的记录。update 方法和 insert 方法一样，接收含有字段及值的数组，其中包括要更新的字段
         *      使用 where 子句来约束 update 查找
         *
         *      更新 JSON 列
         *          todo
         *
         *      自增或自减
         *          DB::table('users')->increment('votes');
         *          DB::table('users')->increment('votes', 5);
         *
         *          DB::table('users')->decrement('votes');
         *          DB::table('users')->decrement('votes', 5);
         *
         *          指定要操作中更新其它字段
         *              DB::table('users')->increment('votes', 1, ['name' => 'John']);
         *
         * Deletes
         *      delete 方法从数据表中删除记录。delete 前，还可使用 where 子句来约束 delete 语法
         *          DB::table('users')->delete();
         *          DB::table('users')->where('votes', '>', 100)->delete();
         *
         *      truncate 方法清空表，并重置自动递增 ID 为零
         *          DB::table('users')->truncate();
         *
         * 悲观锁
         *      todo
         */
        // name => email 的 pairs
//        return DB::table('users')->pluck('email', 'name');

        // chunk 方法结果分块
//        DB::table('users')->orderBy('id')->chunk(1, function($users) {
//            foreach ($users as $user) {
//                var_dump($user->email);
//
//                // stop
//                return false;
//            }
//        });

        // addSelect
//        $query = DB::table('users')->select('name');
//        return $users = $query->addSelect('email')->get();

        // union
//        $first = DB::table('users')->where('id', 2);
//        $users = DB::table('users')->where('id', 1)->union($first)->get();
//        return $users;

//        return $users = DB::table('users')->where([
//            ['id', '=', '1'],
//            ['name', '=', 'Dymyw'],
//        ])->get();

        // latest
//        return (array) DB::table('users')->oldest('id')->first();

        // increment
        DB::table('users')->where('email', 'dymayongwei@163.com')->increment('id', 6, ['name' => 'John']);
        return DB::table('users')->get();
    }
}
