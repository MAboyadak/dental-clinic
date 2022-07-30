<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('work')->nullable();
            $table->double('cost');
            $table->unsignedInteger('program_id');
            $table->foreign('program_id')->references('id')->on('programs')->onUpdate('cascade');
            $table->unsignedInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onUpdate('cascade');
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
        Schema::dropIfExists('sessions');
    }
}
