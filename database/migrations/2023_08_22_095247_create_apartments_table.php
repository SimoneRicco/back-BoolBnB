<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('slug', 50)->unique();
            $table->string('title', 100);
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds');
            $table->tinyInteger('bathrooms');
            $table->smallInteger('square_meters');
            $table->boolean('available');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('image_id');
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('image_id')->references('id')->on('images');
           
            
            $table->softDeletes();

        });
    }

    
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            // elimino la chiave esterna

            $table->dropForeign('apartments_user_id_foreign');
            $table->dropForeign('apartments_address_id_foreign');
            $table->dropForeign('apartments_image_id_foreign');
        

            // elimino la colonna

            $table->dropColumn('user_id');
            $table->dropColumn('address_id');
            $table->dropColumn('image_id'); 
        });

    }
};
