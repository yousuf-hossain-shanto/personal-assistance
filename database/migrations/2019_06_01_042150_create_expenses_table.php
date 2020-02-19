<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('expense_sector_id')->nullable()->unsigned();
            $table->bigInteger('expense_head_id')->nullable()->unsigned();
            $table->bigInteger('wallet_id')->nullable()->unsigned();
            $table->bigInteger('refer_id')->nullable()->comment('Recurring table ID');
            $table->timestamp('date')->nullable();
            $table->string('amount')->default(0);
            $table->string('remarks')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending for approval, 1=paid, 2=due for next');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('expense_sector_id')->references('id')->on('expense_sectors')->onDelete('RESTRICT');
            $table->foreign('expense_head_id')->references('id')->on('expense_heads')->onDelete('RESTRICT');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('RESTRICT');
            $table->foreign('refer_id')->references('id')->on('recurring_expenses')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
