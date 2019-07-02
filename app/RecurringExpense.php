<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecurringExpense extends Model
{
    protected $guarded = ['id'];

    public function head()

    {

        return $this->belongsTo(ExpenseHead::class, 'expense_head_id', 'id');

    }

    public function getAmountIntervalAttribute( $value )

    {

        switch ($this->days_count) {
            case 1:
                return $this->amount . ' ' . config('app.currency') . ' per day';
            case 30:
                return $this->amount . ' ' . config('app.currency') . ' per month';
            case 90:
                return $this->amount . ' ' . config('app.currency') . ' per quarter year';
            case 120:
                return $this->amount . ' ' . config('app.currency') . ' per 1/3 year';
            case 180:
                return $this->amount . ' ' . config('app.currency') . ' per half year';
            case 360:
                return $this->amount . ' ' . config('app.currency') . ' per year';
            default:
                return $this->amount . ' ' . config('app.currency') . ' per ' . $this->days_count . ' days';
        }

    }

    public function getLastProcessedAttribute()

    {



    }
}
