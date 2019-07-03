<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date'];

    public function from()

    {

        return $this->belongsTo(Wallet::class, 'from_wallet', 'id');

    }

    public function to()

    {

        return $this->belongsTo(Wallet::class, 'to_wallet', 'id');

    }

    public function setDateAttribute( $date )

    {

        $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $date);

    }
}
