<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date'];

    public function wallet()

    {

        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');

    }

    public function setDateAttribute( $date )

    {

        $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $date);

    }
}
