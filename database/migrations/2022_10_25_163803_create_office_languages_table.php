<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_languages', function (Blueprint $table) {
            $table->integer('language_id')->unsigned();
            $table->bigInteger('office_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('recruitment_form_languages')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('office_languages');
    }
}
