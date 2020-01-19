<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXyBookTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_type', function (Blueprint $table)
        {
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('pid')->default(0)->comment('父类id');
            $table->unsignedInteger('uid')->default(10000)->comment('用户id');
            $table->string('title', 100)->comment('标题');
            $table->string('remark', 200)->comment('备注');
            $table->unsignedInteger('sort')->default(1)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态1 正常 0 冻结');
            $table->unsignedInteger('create_time')->default(0)->comment('创建时间');
            $table->unsignedInteger('update_time')->default(0)->comment('最后修改');
            $table->softDeletes()->comment('软删除');

            $table->index('uid');
            $table->index('pid');

            $table->engine = 'InnoDB';
        });

        DB::statement("ALTER TABLE `xy_book_type` comment '书籍'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xy_book_type');
    }
}
