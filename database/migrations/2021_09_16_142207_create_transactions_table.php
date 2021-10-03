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
            $table->unsignedBigInteger('budget_id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('category_id');
            $table->float('amount', 9, 2);
            $table->timestamps();

            $table->foreign('budget_id')->references('id')->on('budgets');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('option_id')->references('id')->on('payment_options');
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
