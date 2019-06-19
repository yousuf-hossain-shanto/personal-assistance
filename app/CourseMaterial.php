<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['date'];

    protected $casts = [
      'shared' => 'array'
    ];

    public function course()

    {

        return $this->belongsTo(Course::class, 'course_id', 'id');

    }
}
