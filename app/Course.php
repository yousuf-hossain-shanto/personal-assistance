<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['start', 'end'];

    protected $casts = [
      'shared' => 'array'
    ];

    public function materials()

    {

        return $this->hasMany(CourseMaterial::class, 'course_id', 'id');

    }
}
