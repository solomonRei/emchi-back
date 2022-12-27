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
            $table->string('id')->autoIncrement();
            $table->string('name');
            $table->string('login')->unique();
            $table->string('password');
            $table->string('dateBirth');
            $table->string('phone');
            $table->unsignedInteger('idPolis')->nullable();
            $table->unsignedInteger('inn')->nullable();
            $table->unsignedInteger('snils')->nullable();
            $table->string('workplace');
            $table->string('remember_token');
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
