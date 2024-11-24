<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('central', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('phone', 255);
            $table->text('status');
            $table->string('employee_by', 255)->nullable();
            $table->text('details')->nullable();
            $table->date('date');
            $table->time('time')->nullable();
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
        Schema::dropIfExists('central');
    }
}
