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
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('store_id')->default(1);
            $table->text('notes')->nullable();
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
