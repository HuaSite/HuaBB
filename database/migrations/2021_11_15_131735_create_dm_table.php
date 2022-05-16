<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm', function (Blueprint $table) {
            $table->id();
            $table->integer('dm_user_id');
            $table->string('dm_user_idname');
            $table->string('dm_username');
            $table->string('user_avatar');
            $table->string('file');
            $table->string('room_id');
            $table->integer('user1');
            $table->integer('user2');
            $table->longtext('body');
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
        Schema::dropIfExists('dm');
    }
}
