<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseClass extends Pivot
{
    protected $guarded = [];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function class(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MajorClass::class, 'class_id');
    }

    public function lecturer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }
}
