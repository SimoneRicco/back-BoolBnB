<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->string('address', 200);
            $table->string('latitude', 200);
            $table->string('longitude', 200);

            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
