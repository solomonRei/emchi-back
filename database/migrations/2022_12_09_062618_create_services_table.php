<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('notification_id')->nullable();
            $table->string('title', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('number', 50)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->integer('clinicId');
            $table->unsignedInteger('doctor_id');
            $table->string('kind', 50)->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('entryTypeId')->nullable();
            $table->unsignedInteger('parentEntryId')->nullable();
            $table->double('price');
            $table->integer('amount')->nullable();
            $table->unsignedInteger('sum');
            $table->integer('finalSum');
            $table->string('date', 100)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('status', 50)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('description')->collation('utf8mb4_unicode_ci');
            $table->text('testimony')->collation('utf8mb4_unicode_ci');
            $table->text('restriction')->collation('utf8mb4_unicode_ci');
            $table->text('result')->collation('utf8mb4_unicode_ci');
            $table->string('token_pdf', 256)->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('services');
    }
}
