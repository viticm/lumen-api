<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerOptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_opts', function (Blueprint $table) {
            $table->id();
            $table->integer('server_id')->comment('服务器ID');
            $table->string('server_name')->comment('服务器名');
            $table->string('type')->comment('服务器类型');
            $table->string('inner_ip', 32)->comment('内网IP');
            $table->string('net_ip', 32)->comment('外网IP');
            $table->integer('port')->comment('监听端口');
            $table->text('db')->nullable()->comment('数据库配置');
            $table->text('pcl')->nullable()->comment('平台配置');
            $table->tinyInteger('auth_count')->nullable()->comment('验证数量');
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
        Schema::dropIfExists('server_opts');
    }
}
