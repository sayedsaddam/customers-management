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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('accountTitle')->after('address')->nullable();
            $table->string('bankName')->after('accountTitle')->nullable();
            $table->string('branchCode')->after('bankName')->nullable();
            $table->string('accountNumber')->after('branchCode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('accountTitle');
            $table->dropColumn('bankName');
            $table->dropColumn('branchCode');
            $table->dropColumn('accountNumber');
        });
    }
};
