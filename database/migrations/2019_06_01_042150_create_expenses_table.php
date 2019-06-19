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
            $table->bigInteger('expense_head_id')->unsigned();
            $table->bigInteger('refer')->nullable()->comment('Recurring table ID');
            $table->timestamp('date')->nullable();
            $table->string('amount')->default(0);
            $table->string('remarks')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending for approval, 1=paid, 2=due for next');
            $table->timestamps();
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
        Schema::dropIfExists('expenses');
    }
}
