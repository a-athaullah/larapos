<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsToVariousTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('varian')->nullable();
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_served')->default(false);
            $table->integer('payment_type')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('varian');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('is_paid');
            $table->dropColumn('is_served');
            $table->dropColumn('payment_type');
        });
    }
}
