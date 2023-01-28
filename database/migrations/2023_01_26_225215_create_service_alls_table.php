<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('services_all', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('services_all_id');
            $table->unsignedInteger('category_id');
            $table->string('title', 512)->nullable();
            $table->double('price')->nullable();
            $table->text('clinics_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services_all');
    }
};
