<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['student', 'courseClass'];

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function courseClass(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CourseClass::class);
    }

    protected function studentImage(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Storage::disk('public')->url($value),
        );
    }

    protected function lecturerImage(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Storage::disk('public')->url($value),
        );
    }
}
