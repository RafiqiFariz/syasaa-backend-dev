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
            get: function (?string $value) {
                if (!$value) return null;

                // Jika dari web pihak ketiga
                if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
                    return $value;
                }

                // Jika file dari folder public/img
                if (str_starts_with($value, 'img/')) {
                    return env('APP_URL') . '/' . $value;
                }

                // Sisanya dari storage
                return Storage::disk('public')->url($value);
            },
        );
    }

    protected function lecturerImage(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                if (!$value) return null;

                if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
                    return $value;
                }

                if (str_starts_with($value, 'img/')) {
                    return env('APP_URL') . '/' . $value;
                }

                return Storage::disk('public')->url($value);
            },
        );
    }
}
