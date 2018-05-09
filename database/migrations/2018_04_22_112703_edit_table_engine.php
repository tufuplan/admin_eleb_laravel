<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableEngine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
        });
//        Schema::table('businesses_info', function (Blueprint $table) {
//            $table->engine = 'InnoDB';
//        });
//        Schema::table('dishes', function (Blueprint $table) {
//            $table->engine = 'InnoDB';
//        });
//        Schema::table('fcategories', function (Blueprint $table) {
//            $table->engine = 'InnoDB';
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
