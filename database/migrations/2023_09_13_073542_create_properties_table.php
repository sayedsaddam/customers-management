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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->enum('type', array('commercial', 'residential', 'mix-use'))->nullable();
            $table->string('purchasePrice')->nullable();
            $table->string('currentPrice')->nullable();
            $table->dateTime('purchaseDate')->nullable();
            $table->boolean('status')->default(1);
            $table->string('owner')->nullable();
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
        Schema::dropIfExists('properties');
    }
};
