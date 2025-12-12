<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIdToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('payment_id')
                ->on('payments')->onDelete('cascade');
            $table->dropColumn('payment_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('payment_type')->default(1);
            $table->dropForeign('payment_id');
            $table->dropColumn('payment_id');
        });
    }
}
