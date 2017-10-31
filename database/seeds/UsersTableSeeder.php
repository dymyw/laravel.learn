<?php
/**
 * Laravel 数据库之：数据填充
 *      Laravel 可以用 seed 类轻松地为数据库填充测试数据。所有的 seed 类都存放在 database/seeds 目录下
 *      应该遵守类似 UsersTableSeeder 的命名规范
 *      Laravel 默认定义了一个 DatabaseSeeder 类。可以在这个类中使用 call 方法来运行其它的 seed 类来控制数据填充的顺序
 *
 * 生成一个 Seeder
 *      php artisan make:seeder UsersTableSeeder
 *
 *      一个 seeder 类只包含一个默认方法：run。这个方法在 db:seed Artisan 命令 被调用时执行
 *      在 run 方法里你可以为数据库添加任何数据
 *      也可以用 查询语句构造器 或 Eloquent 模型工厂 来手动添加数据
 *
 * 使用模型工厂
 *      todo
 *
 * 调用其他 Seeders
 *      call 方法来运行其他的 seed 类。为避免单个 seeder 类过大，可使用 call 方法将数据填充拆分成多个文件
 *          $this->call(UsersTableSeeder::class);
 *
 * 运行 Seeders
 *      php artisan db:seed
 *
 *      用 --class 选项来单独运行一个特定的 seeder 类
 *          php artisan db:seed --class=UsersTableSeeder
 *
 *      先回滚再重新运行所有迁移的 migrate:refresh 命令来填充数据库。在彻底重构数据库时非常有用
 *          php artisan migrate:refresh --seed
 */

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert
        DB::table('users')->insert(
            [
                'name' => str_random(10),
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ]
        );
    }
}
