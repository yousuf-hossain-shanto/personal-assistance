<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImapMessage extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'from' => 'array',
        'attachments' => 'array'
    ];
}
