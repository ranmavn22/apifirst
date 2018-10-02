<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('service_token')->nullable();
            $table->string('auth_token')->nullable();
            $table->integer('status')->default('1');
            $table->string('account_type')->nullable()->comment('1: Account-pass 2:Face 3:twitter 4:Ins 5:Google');
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
        Schema::dropIfExists('api_customers');
    }
}
