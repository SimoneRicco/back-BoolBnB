<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();

            $table->string('ip_address', 100);
            $table->date('view_date');
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments');

            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('views');
    }
};