<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('notification_type', 100);
            $table->bigInteger('sender_id')->default(0);
            $table->bigInteger('receiver_id')->default(0);
            $table->text('message')->nullable();
            $table->text('link')->nullable();
            $table->timestamps()->default('current_timestamp()');
            $table->string('showing_panel', 255)->nullable();
            $table->integer('request_id')->nullable();
            $table->boolean('seen_by_receiver')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
