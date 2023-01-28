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
            $table->unsignedInteger('user_id');
            $table->string('login', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->notNullable();
            $table->string('phone', 255)->unique();
            $table->string('name', 255)->notNullable();
            $table->string('surname', 255)->nullable();
            $table->string('secondName', 255)->nullable();
            $table->string('birthdate', 255)->nullable();
            $table->unsignedInteger('idPolis')->nullable();
            $table->unsignedInteger('inn')->nullable();
            $table->unsignedInteger('snils')->nullable();
            $table->string('workplace', 255)->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->timestamps();
            $table->timestamp('login_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
