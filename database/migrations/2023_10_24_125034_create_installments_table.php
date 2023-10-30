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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('investment_id')->nullable();
            $table->string('paymentMode')->nullable();
            $table->string('referenceNo')->nullable();
            $table->string('bankName')->nullable();
            $table->string('branchCode')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->dateTime('receivedAt')->nullable();
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
        Schema::dropIfExists('installments');
    }
};
