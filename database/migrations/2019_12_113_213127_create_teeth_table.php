<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeethTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('teeth');
        // Schema::dropIfExists('appointment_details');
        Schema::create('teeth', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('condition')->default('normal');
            $table->string('details')->nullable();
            $table->text('description')->nullable();
            $table->boolean('left')->nullable()->default(0);
            $table->boolean('top')->nullable()->default(0);
            $table->boolean('right')->nullable()->default(0);
            $table->boolean('bottom')->nullable()->default(0);
            $table->boolean('center')->nullable()->default(0);
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
        Schema::dropIfExists('teeth');
    }
}
