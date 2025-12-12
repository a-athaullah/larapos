<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');
            $table->unsignedFloat('total');
            $table->unsignedFloat('total_cost');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('store_id')->default(1);
            $table->foreign('store_id')->references('store_id')
                ->on('stores')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_served')->default(false);
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('payment_id')
                ->on('payments')->onDelete('cascade');
            $table->timestamps();
            $table->date('created')->nullable();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
