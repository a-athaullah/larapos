<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMultipleColumnsToVariousTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('total_sold')->default(0);
            $table->foreign('store_id')->references('store_id')
                ->on('stores')->onDelete('cascade');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('store_id')->references('store_id')
                ->on('stores')->onDelete('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('store_id')->references('store_id')
                ->on('stores')->onDelete('cascade');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('store_id')->references('store_id')
                ->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('store_id');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('store_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('store_id');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign('store_id');
        });
    }
}
