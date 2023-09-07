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
            $table->integer('duration');
            $table->string('type', 50);
            $table->float('price');


            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
};
