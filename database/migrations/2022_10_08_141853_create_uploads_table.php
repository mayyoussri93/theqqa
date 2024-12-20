<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('file_original_name', 255)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('type', 15)->nullable();
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
        Schema::dropIfExists('uploads');
    }
}
