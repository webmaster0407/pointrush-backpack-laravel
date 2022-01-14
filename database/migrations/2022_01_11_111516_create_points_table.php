<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->decimal('lat', 11, 8)->nullable();
            $table->decimal('lon', 11, 8)->nullable();
            $table->dateTime('start', 0)->nullable();
            $table->dateTime('stop', 0)->nullable();
            $table->integer('radius')->nullable();
            $table->boolean('time')->default(0);
            $table->boolean('showtitle')->default(0);
            $table->boolean('distort')->default(0);
            $table->integer('distortion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
