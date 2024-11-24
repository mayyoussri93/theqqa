<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_outs', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->integer('user_id')->nullable();
            $table->text('service');
            $table->string('city', 255);
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
        Schema::dropIfExists('client_outs');
    }
}
