<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EarningSource extends Model
{
    protected $guarded = ['id'];

    public function earnings()

    {

        return $this->hasMany(Earning::class, 'earning_source_id', 'id');

    }

    public function getDescExcerptAttribute($value)

    {

        return Str::limit($this->description);

    }
}
