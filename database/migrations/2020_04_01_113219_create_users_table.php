<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100)->comment('用户名');
            $table->string('email', 100)->comment('邮箱');
            $table->string('password', 60)->comment('密码');
            $table->string('remember_token', 60)->comment('验证字符串')->nullable();
            $table->string('name', 100)->comment('昵称')->default('懒猪');
            $table->string('roles', 100)->comment('角色列表json');
            $table->string('introduction', 100)
                  ->comment('个人介绍')->default('这家伙很懒，什么也没留下');
            $table->string('avatar', 100)->comment('头像')->default('');
            $table->boolean('active')->default(1)->comment('是否启用 0 禁用 1 启用');
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
        Schema::dropIfExists('users');
    }
}
