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
            $table->string('fatherName')->nullable();
            $table->string('cnic')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('nokName')->nullable();
            $table->string('nokCnic')->nullable();
            $table->string('nokPhone')->nullable();
            $table->string('nokEmail')->nullable();
            $table->string('nokRelation')->nullable();
            $table->enum('status', array('active', 'inactive', 'cancelled', 'buyback'))->defaul('active');
            $table->decimal('investmentAmount', 10, 2)->nullable();
            $table->date('investmentDate')->nullable();
            $table->foreignId('user_id')->constrained();
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
