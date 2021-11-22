<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('company');
            $table->string('company_symbol');
            $table->time('bought_at');
            $table->float('buy_price');
            $table->integer('amount_bought');
            $table->float('usd_invested');
            $table->time('sold_at')->nullable()->default(null);
            $table->float('sell_price')->nullable()->default(null);
            $table->float('profit')->nullable()->default(null);
            $table->float('profit_to_investment')->nullable()->default(null);
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
        Schema::dropIfExists('trade_transactions');
    }
}
