<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('expense_sector_id')->unsigned();
            $table->bigInteger('expense_head_id')->unsigned();
            $table->string('amount')->default(0);
            $table->string('days_count')->default(1)->comment('days_count will be days count of interval');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('expense_sector_id')->references('id')->on('expense_sectors')->onDelete('RESTRICT');
            $table->foreign('expense_head_id')->references('id')->on('expense_heads')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurring_expenses');
    }
}
