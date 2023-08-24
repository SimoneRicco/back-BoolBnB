<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('apartment_sponsor', function (Blueprint $table) {

            $table->unsignedInteger('duration');
            
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsor_id');

            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('apartment_sponsor');
    }
};
