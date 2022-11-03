<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faith_users', function (Blueprint $table) {
            $table->id();
            $table->string('account', 32)->comment('账号');
            $table->string('password', 128)->comment('密码')->nullable();
            $table->string('token', 512)->comment('令牌')->nullable();
            $table->string('channel', 32)->comment('渠道')->nullable();

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
        Schema::dropIfExists('faith_users');
    }
};
