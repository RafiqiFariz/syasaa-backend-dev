<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UpdateProfileRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => $value ? Storage::disk('public')->url($value) : null,
        );
    }
}
