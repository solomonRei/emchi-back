<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('record_id');
            $table->unsignedInteger('notification_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('clinic_id');
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('doctor_id');
            $table->string('status',100);
            $table->string('date',50);
            $table->string('time',50)->nullable();
            $table->integer('duration')->nullable();
            $table->string('note',256)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('call_confirmation_status',100)->nullable();
            $table->string('appointment_type',100)->nullable();
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
        Schema::dropIfExists('records');
    }
}
