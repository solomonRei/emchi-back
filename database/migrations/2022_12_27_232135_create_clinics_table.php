<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('clinic_id');
            $table->string('title')->nullable();
            $table->string('legal_name')->nullable();
            $table->string('address_country')->nullable();
            $table->string('address_region')->nullable();
            $table->string('address_area')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_house')->nullable();
            $table->string('address_flat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clinics');
    }
};
