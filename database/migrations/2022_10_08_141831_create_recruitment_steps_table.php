<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_steps', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('title', 255);
            $table->text('description');
            $table->text('image')->nullable();
            $table->text('icons')->nullable();
            $table->string('link', 255)->nullable();
            $table->timestamps()->default('current_timestamp()');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment_steps');
    }
}
