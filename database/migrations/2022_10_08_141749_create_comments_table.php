<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('blog_id');
            $table->string('name', 255);
            $table->longText('details')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('status', 10)->default('pending');
            $table->integer('viewed')->default(0);
            $table->integer('client_viewed')->default(0);
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
        Schema::dropIfExists('comments');
    }
}
