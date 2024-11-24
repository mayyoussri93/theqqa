<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_setting', function (Blueprint $table) {
            $table->integer('id')->index()->unique();
            $table->text('current_url');
            $table->string('meta_title', 255);
            $table->string('meta_img', 255)->nullable();
            $table->text('meta_h1')->nullable();
            $table->text('meta_description');
            $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('seo_setting');
    }
}
