<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiConversationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_conversation_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("conversation_id")->nullable();
            $table->integer("user_id")->nullable();
            $table->integer("type_user")->nullable();
            $table->integer("status")->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_conversation_users');
    }
}
