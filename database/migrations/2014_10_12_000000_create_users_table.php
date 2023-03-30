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
            $table->id();
            $table->string('full_name');
            $table->string('username')->nullable();
            $table->enum('role',['admin','vendor','customer'])->default('customer');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('status',['active','inactive','customer'])->default('active');

            $table->string('b_country')->nullable();
            $table->string('b_city')->nullable();
            $table->string('b_postcode')->nullable();
            $table->string('b_state')->nullable();
            $table->string('b_address')->nullable();

            $table->string('s_country')->nullable();
            $table->string('s_city')->nullable();
            $table->string('s_postcode')->nullable();
            $table->string('s_state')->nullable();
            $table->string('s_address')->nullable();

            $table->rememberToken();
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
