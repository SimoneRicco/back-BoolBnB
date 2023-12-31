<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsor', function (Blueprint $table) {
            $table->date('subscription_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->float('price');
            $table->string('order_code', 20);
            $table->boolean('valid')->default(true);

            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsor_id');

            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_sponsor');
    }
};
