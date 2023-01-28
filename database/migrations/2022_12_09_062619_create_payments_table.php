<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id');
            $table->integer('notification_id')->nullable();
            $table->integer('clinic_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('customerId')->nullable();
            $table->enum('customerType', ['client', 'company'])->default('client');
            $table->string('date', 255);
            $table->double('sum');
            $table->double('finalSum');
            $table->string('orderPaidStatus', 50);
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
        Schema::dropIfExists('payments');
    }
}
