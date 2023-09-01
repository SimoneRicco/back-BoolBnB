<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->text('message');
            $table->string('email', 100);
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // elimino la chiave esterna
            $table->dropForeign('messages_apartment_id_foreign');

            // elimino la colonna
            $table->dropColumn('apartment_id');
        });
    }
};
