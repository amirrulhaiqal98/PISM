<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberClubTable extends Migration
{
    public function up()
    {
        Schema::create('member_club', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('club_id');
            $table->unsignedBigInteger('role_id');
            $table->string('status');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('club_id')->references('id')->on('club_types');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('member_club');
    }
}
