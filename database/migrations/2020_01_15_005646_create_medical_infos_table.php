<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('blood_pressure')->nullable();
            $table->boolean('diabetes')->nullable();
            $table->text('diabetes_details')->nullable();
            $table->boolean('heart')->nullable();
            $table->boolean('sensitivity')->nullable();
            $table->text('sensitivity_details')->nullable();
            $table->boolean('other')->nullable();
            $table->text('other_details')->nullable();
            $table->boolean('pregnant')->nullable();
            $table->text('pregnant_details')->nullable();
            $table->boolean('breast_feeding')->nullable();
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
        Schema::dropIfExists('medical_infos');
    }
}
