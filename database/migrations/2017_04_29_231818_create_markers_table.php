<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markers', function (Blueprint $table) {
            $table->increments('id');
            $table->float('lat');
            $table->float('lng');
            $table->float('speed');
            $table->unsignedInteger('position');
            $table->foreign('position')->references('id')->on('rectangles');
            $table->unsignedInteger('record_user');
            $table->foreign('record_user')->references('id')->on('users');
            $table->timestamp('record_time');
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
        //
    }
}
