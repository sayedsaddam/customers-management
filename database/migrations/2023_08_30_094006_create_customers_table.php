<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->decimal('investment_amount', 10, 2);
            $table->date('investment_date')->nullable();
            $table->boolean('buyback_status')->default(false);
            $table->decimal('buyback_amount', 10, 2);
            $table->date('buyback_date')->nullable();
            $table->boolean('status')->default(true);
            $table->string('user_id')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
