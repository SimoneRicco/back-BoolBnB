<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apartment_utility', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('utility_id');

            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('utility_id')->references('id')->on('utilities');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('apartment_utility');
    }
};
