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
            $table->string('address', 200);
            $table->boolean('visible');
            $table->softDeletes();

        });
    }

    
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            // elimino la chiave esterna

            $table->dropForeign('apartments_user_id_foreign');

            // elimino la colonna

            $table->dropColumn('user_id');
        });

    }
};
