<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            //活动名称
            $table->string('name');
            //活动内容
            $table->text('content');
            //活动所属商户
            $table->integer('business_id');
            //活动的状态是否过期
            $table->tinyInteger('status');
            //活动的举办日期
            $table->integer('start_time');
            $table->integer('end_time');
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
        Schema::dropIfExists('activities');
    }
}
