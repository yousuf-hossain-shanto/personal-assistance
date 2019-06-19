<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ExpenseHead extends Model
{
    protected $guarded = ['id'];

    public function recurrings()

    {

        return $this->hasMany(RecurringExpense::class, 'expense_head_id', 'id');

    }

    public function expenses()

    {

        return $this->hasMany(Expense::class, 'expense_head_id', 'id');

    }

    public function getDescExcerptAttribute( $value )

    {

        return Str::limit($this->description);

    }
}
