<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->boolean('cover_image');
            $table->string('name', 100);
            $table->string('url', 200);
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            // elimino la chiave esterna
            $table->dropForeign('images_apartment_id_foreign');

            // elimino la colonna
            $table->dropColumn('apartment_id');
        });
    }
};
