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
            $table->integer('duration')->nullable()->default(30);
            $table->string('type', 50);
            $table->integer('price');


            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
};
