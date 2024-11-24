<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_airports', function (Blueprint $table) {
            $table->unsignedBigInteger('airport_id');
            $table->unsignedBigInteger('office_id');
            $table->foreign('airport_id')->references('id')->on('airports')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['airport_id', 'office_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_airports');
    }
}
