<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['class'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function class(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MajorClass::class, 'class_id');
    }
}
