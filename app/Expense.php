<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date'];

    public function head()

    {

        return $this->belongsTo(ExpenseHead::class, 'expense_head_id', 'id');

    }

    public function setDateAttribute( $date )

    {

        $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $date);

    }
}
