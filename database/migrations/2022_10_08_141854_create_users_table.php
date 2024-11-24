<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referred_by')->nullable();
            $table->string('provider_id', 50)->nullable();
            $table->string('user_type', 20)->default('customer');
            $table->string('name');
            $table->string('email')->nullable()->unique('users_email_unique');
            $table->timestamp('phone_verified_at')->nullable();
            $table->text('verification_code')->nullable();
            $table->text('email_verificiation_code')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('avatar', 256)->nullable();
            $table->string('avatar_original', 256)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('region', 255);
            $table->string('postal_code', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp_phone', 255)->nullable();
            $table->double('balance', 20, 2)->default(0.00);
            $table->boolean('banned')->default(0);
            $table->string('referral_code', 255)->nullable();
            $table->integer('customer_package_id')->nullable();
            $table->integer('remaining_uploads')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
