<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->comment('名称')->nullable();
            $table->string('path', 100)->comment('路径');
            $table->string('component', 100)->comment('模板')->nullable();
            $table->string('redirect', 100)->comment('定向路径')->nullable();
            $table->string('meta', 100)->nullable();
            $table->string('children', 128)->comment('子路径')->nullable();
            $table->boolean('alwaysShow')->default(0)->comment('是否常驻');
            $table->boolean('hidden')->default(0)->comment('是否隐藏');
            $table->boolean('root')->default(0)->comment('是否为一级路由');
            $table->boolean('constant')->default(0)->comment('是否固定');
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
        Schema::dropIfExists('routes');
    }
}
