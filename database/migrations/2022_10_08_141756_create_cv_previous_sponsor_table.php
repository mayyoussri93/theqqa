<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvPreviousSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_previous_sponsor', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('cv_id');
            $table->boolean('is_active')->default(0);
            $table->integer('duration_id');
            $table->integer('reason_id');
            $table->string('sponsorship_transfer_fee', 255);
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
        Schema::dropIfExists('cv_previous_sponsor');
    }
}
