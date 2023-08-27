<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();

            $table->string('type', 50);
            $table->integer('price');
            $table->date('subscription_date');
            $table->integer('duration')->default(0);

            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
};
