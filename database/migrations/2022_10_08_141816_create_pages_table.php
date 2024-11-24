<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('type', 50);
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->longText('content')->nullable();
            $table->string('loading_site_icon', 255)->nullable();
            $table->string('loading_website_title', 255);
            $table->string('loading_whatsapp_link', 255);
            $table->string('loading_phone', 255);
            $table->text('meta_title')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('keywords', 1000)->nullable();
            $table->string('meta_image', 255)->nullable();
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
        Schema::dropIfExists('pages');
    }
}
