<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('author', 32)->comment('作者');
            $table->string('reviewer', 32)->comment('评论者')->nullable();
            $table->string('title', 100)->comment('标题')->nullable();
            $table->string('content_short', 100)->comment('内容简介')->nullable();
            $table->text('content')->comment('内容')->nullable();
            $table->float('forecast')->default(0.0);
            $table->tinyInteger('importance')->default(1)->comment('重要程度');
            $table->enum('type', ['CN', 'US', 'JP', 'EU'])->default('CN')->comment('语言类型');
            $table->enum('status', ['published', 'draft'])->default('draft')->comment('状态');
            $table->boolean('comment_disabled')->default(false)->comment('是否不能评论');
            $table->integer('pageviews')->default(0)->comment('页面访问量');
            $table->string('source_uri', 255)->nullable()->comment('源路径');
            $table->text('image_uri')->nullable()->comment('图片路径');
            $table->string('platforms', 64)->comment('平台列表')->nullable();
            $table->string('remark', 255)->comment('评论')->nullable();
            $table->timestamp('display_time')->comment('展示时间')->nullable();

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
        Schema::dropIfExists('articles');
    }
}
