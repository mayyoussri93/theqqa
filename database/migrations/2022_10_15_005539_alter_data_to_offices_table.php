<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDataToOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->string('office_phone');
            $table->string('office_commercial_id');
            $table->bigInteger('office_country')->unsigned();
            $table->foreign('office_country')->references('id')->on('countries');
            $table->bigInteger('office_city')->unsigned();
            $table->foreign('office_city')->references('id')->on('cities');
            $table->string('office_street');
            $table->bigInteger('office_bank_country')->unsigned();
            $table->foreign('office_bank_country')->references('id')->on('countries');
            $table->string('office_bank_account_name');
            $table->string('office_bank_code');
            $table->string('office_notes');
            $table->dropColumn('name');
            $table->bigInteger('office_manager_id')->unsigned();
            $table->foreign('office_manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offices', function (Blueprint $table) {
            //
        });
    }
}
