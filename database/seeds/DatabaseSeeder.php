<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * call 方法来运行其他的 seed 类
         *      为避免单个 seeder 类过大，可使用 call 方法将数据填充拆分成多个文件
         */
        $this->call(UsersTableSeeder::class);
    }
}
