<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->string('password');
            $table->integer('group')->nullable();
            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->dateTime('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('birthday')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('status')->default('1');
            $table->string('last_login')->nullable();
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
        Schema::dropIfExists('api_admins');
    }
}
