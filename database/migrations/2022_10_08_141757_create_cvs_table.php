<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('images');
            $table->string('new_image', 255)->nullable();
            $table->text('passport_id')->nullable();
            $table->double('salary')->default(0);
            $table->boolean('cv_rev_type')->default(1);
            $table->double('service_price')->default(0);
            $table->integer('national_id')->nullable();
            $table->integer('occuption_id')->nullable();
            $table->text('skills')->nullable();
            $table->string('cv_log_id', 255)->nullable();
            $table->integer('social_id')->nullable();
            $table->integer('age_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('personal_image', 255)->nullable();
            $table->string('lang_id', 255)->nullable();
            $table->string('lang_percentage', 255)->nullable();
            $table->string('lang_merage', 255)->nullable();
            $table->integer('exper_id')->nullable();
            $table->boolean('is_booking')->default(0);
            $table->boolean('is_sale')->default(0);
            $table->string('office', 255)->nullable();
            $table->text('cvs_name')->nullable();
            $table->date('passport_release_date')->nullable();
            $table->string('passport_release_place', 255)->nullable();
            $table->date('passport_finish_release_date')->nullable();
            $table->string('duration_contract', 255)->nullable();
            $table->integer('child_num')->nullable();
            $table->string('learning', 255)->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('length')->nullable();
            $table->timestamps()->default('current_timestamp()');
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cvs');
    }
}
