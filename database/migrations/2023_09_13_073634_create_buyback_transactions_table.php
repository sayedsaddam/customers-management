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
        Schema::create('buyback_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable();
            $table->bigInteger('buybackAmount')->nullable();
            $table->dateTime('buybackDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyback_transactions');
    }
};
