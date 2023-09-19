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
        Schema::table('investments', function (Blueprint $table) {
            $table->enum('rentalStatus', array('active', 'inactive'))->after('project')->nullable();
            $table->string('floorName')->after('rentalPercentage')->nullable();
            $table->string('sqft')->after('floorName')->nullable();
            $table->string('rate')->after('floorName')->nullable();
            $table->string('saleValue')->after('rate')->nullable();
            $table->string('amountReceived')->after('saleValue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('rentalStatus');
            $table->dropColumn('floorName');
            $table->dropColumn('sqft');
            $table->dropColumn('rate');
            $table->dropColumn('saleValue');
            $table->dropColumn('amountReceived');
        });
    }
};
