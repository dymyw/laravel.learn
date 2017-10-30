<?php
/**
 * Laravel 的数据库迁移 Migrations
 *      数据库迁移就像是数据库的版本控制，可以让你的团队轻松修改并共享应用程序的数据库结构
 *      Laravel 的 Schema facade 对所有 Laravel 支持的数据库系统提供了创建和操作数据表的相应支持
 *
 * 生成迁移
 *      新的迁移文件将会被放置在 database/migrations 目录中。每个迁移文件的名称都包含了一个时间戳，以便让 Laravel 确认迁移的顺序
 *          php artisan make:migration create_users_table
 *
 * 迁移结构
 *      一个迁移类会包含两个方法: up 和 down
 *      up 方法可为数据库添加新的数据表、字段或索引，而 down 方法则是 up 方法的逆操作
 *
 * 运行迁移
 *      php artisan migrate
 *
 *      强制执行迁移，要忽略此提示并强制运行命令，则可以使用 --force 标记
 *          php artisan migrate --force
 *
 * 回滚迁移
 *      回滚最后一次迁移
 *          php artisan migrate:rollback
 *
 *      step 参数，你可以限制回滚迁移的个数
 *          php artisan migrate:rollback --step=5
 *
 *      migrate:reset 命令可以回滚应用程序中的所有迁移
 *          php artisan migrate:reset
 *
 * 使用单个命令来执行回滚或迁移
 *      migrate:refresh 命令不仅会回滚数据库的所有迁移还会接着运行 migrate 命令。所以此命令可以有效的重新创建整个数据库
 *          php artisan migrate:refresh
 *          刷新数据库结构并执行数据填充
 *              php artisan migrate:refresh --seed
 *      加上 step 参数，你也可以限制执行回滚和再迁移的个数
 *          php artisan migrate:refresh --step=5
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 数据表
         *
         * 要创建一张新的数据表，可以使用 Schema facade 的 create 方法
         *      第一个参数为数据表的名称
         *      第二个参数为一个 闭包，此闭包会接收一个用于定义新数据表的 Blueprint 对象
         *
         * 检查数据表或字段是否存在
         *      todo
         *
         * 数据库连接
         *      Schema::connection('foo')->create()
         *
         * rename 方法重命名一张已存在的数据表
         *      Schema::rename($from, $to);
         */
        Schema::create('demos', function (Blueprint $table) {
            // engine 属性来设置数据表的存储引擎
//            $table->engine = 'InnoDB';

            /**
             * 字段 & 字段修饰
             *
             * 修改字段
             *      在修改字段之前，请务必在你的 composer.json 中增加 doctrine/dbal 依赖
             *      Doctrine DBAL 函数库被用于判断当前字段的状态以及创建调整指定字段的 SQL 查询
             *          composer require doctrine/dbal
             *
             *      change 方法让你可以修改一些已存在的字段类型，或修改字段属性
             *          $table->string('name', 50)->change();
             *          todo
             *
             *      要重命名字段，可使用数据库结构构造器的 renameColumn 方法
             *          $table->renameColumn('from', 'to');
             *
             *      要移除字段，可使用数据库结构构造器的 dropColumn 方法
             *          $table->dropColumn('votes');
             *          $table->dropColumn(['votes', 'avatar', 'location']);
             *
             * 索引
             *      在字段定义之后链式调用 unique 方法来创建索引
             *          $table->string('email')->unique();
             *
             *      在定义完字段之后创建索引
             *          $table->unique('email');
             *
             *      创建复合索引
             *          $table->index(['account_id', 'created_at']);
             *          $table->index(['account_id', 'created_at'], 'my_index_name');
             *
             *      ...
             *
             * 外键约束
             *      todo
             */

            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * drop 或 dropIfExists 方法删除已存在的数据表
         *      Schema::drop('users');
         *      Schema::dropIfExists('users');
         */
        Schema::dropIfExists('demos');
    }
}
