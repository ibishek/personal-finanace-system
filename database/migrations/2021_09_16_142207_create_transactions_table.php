<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desc')->nullable();
            $table->unsignedBigInteger('budgets_id');
            $table->unsignedBigInteger('modes_id');
            $table->unsignedBigInteger('types_id');
            $table->float('amount', 9, 2);
            $table->timestamps();
            
            $table->foreign('budgets_id')->references('id')->on('budgets');
            $table->foreign('types_id')->references('id')->on('types');
            $table->foreign('modes_id')->references('id')->on('payment_modes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
