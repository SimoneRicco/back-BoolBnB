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
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            // elimino la chiave esterna
            $table->dropForeign('addresses_apartment_id_foreign');

            // elimino la colonna
            $table->dropColumn('apartment_id');
        });
    }
};
