<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiConversationMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_conversation_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conversation_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('message')->nullable();
            $table->integer('type')->nullable()->comment('1:text 2:file 3:image');
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('api_conversation_messages');
    }
}
