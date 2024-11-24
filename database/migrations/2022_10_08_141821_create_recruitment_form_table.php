<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_form', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('user_id');
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255);
            $table->string('address', 255);
            $table->integer('iduser')->nullable();
            $table->integer('visa_id')->nullable();
            $table->integer('nationality_id')->nullable();
            $table->integer('occuption_id')->nullable();
            $table->integer('social_id')->nullable();
            $table->integer('age_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('lang_id')->nullable();
            $table->integer('exper_id')->nullable();
            $table->text('requirement_id')->nullable();
            $table->boolean('is_seen')->default(0);
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
        Schema::dropIfExists('recruitment_form');
    }
}
