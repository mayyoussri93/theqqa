<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rservations', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('cv_id');
            $table->integer('last_cv_id')->nullable();
            $table->integer('user_id');
            $table->string('code', 255)->nullable();
            $table->integer('administrator_id')->nullable();
            $table->text('uploads');
            $table->boolean('is_seen')->default(0);
            $table->boolean('status')->default(1);
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->text('address')->nullable();
            $table->timestamp('contract_time')->nullable();
            $table->date('date_arrived')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('rservations');
    }
}
