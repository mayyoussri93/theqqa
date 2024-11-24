<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('job_id');
            $table->string('country');
            $table->double('salary');
            $table->double('cost');
            $table->integer('arrival_period');
            $table->text('cities');
            $table->text('social_statuses');
            $table->text('languages');
            $table->text('skills');
            $table->text('ages');
            $table->text('arrival_airports');
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
        Schema::dropIfExists('office_profiles');
    }
}
