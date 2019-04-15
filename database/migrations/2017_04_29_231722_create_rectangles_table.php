<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRectanglesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rectangles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('height');
            $table->unsignedInteger('width');
            $table->float('avg_speed');
            $table->unsignedInteger('marker_count');
            $table->string('color', 10);
            $table->unsignedInteger('overwrite_user')->nullable();
            $table->foreign('overwrite_user')->references('id')->on('users');
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
