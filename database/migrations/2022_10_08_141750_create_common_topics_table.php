<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_topics', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('main_name', 255);
            $table->string('alt_name', 255);
            $table->text('video');
            $table->integer('count_like')->default(0);
            $table->integer('count_dislike')->default(0);
            $table->text('details');
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
        Schema::dropIfExists('common_topics');
    }
}
