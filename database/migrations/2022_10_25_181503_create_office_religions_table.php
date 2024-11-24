<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeReligionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_religions', function (Blueprint $table) {
            $table->integer('religion_id')->unsigned();
            $table->bigInteger('office_id')->unsigned();
            $table->foreign('religion_id')->references('id')->on('recruitment_form_religions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_religions');
    }
}
