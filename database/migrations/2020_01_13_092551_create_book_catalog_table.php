<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCatalogTable extends Migration
{
    private $tableName = 'xy_book_catalog';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table)
        {
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('pid')->default(0)->comment('父类id');
            $table->unsignedInteger('uid')->default(10000)->comment('用户id');
            $table->string('title', 100)->comment('标题')->default('');
            $table->string('remark', 200)->comment('备注')->default('');
            $table->unsignedInteger('sort')->default(1)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态:3-审核通过/2-审核中/1-待审核/0/-1-审核不通过/-2-封禁/-3-软删除');
            $table->tinyInteger('user_status')->default(1)->comment('状态:1-公开/2-关注/3-互关/4-私有');
            //$table->unsignedInteger('create_time')->default(0)->comment('创建时间');
            //$table->unsignedInteger('update_time')->default(0)->comment('最后修改');
            $table->dateTime('created_at', 0)->comment('创建时间');
            $table->dateTime('updated_at', 0)->comment('最后修改');
            $table->unsignedTinyInteger('type')->default(1)->comment('1 目录 2 文件');

            $table->index('uid');
            $table->index('pid');

            $table->engine = 'InnoDB';
        });

        DB::statement("ALTER TABLE `" . $this->tableName . "` comment '书籍'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
