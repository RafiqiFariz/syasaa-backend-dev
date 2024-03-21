<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorClass extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $guarded = [];
    protected $with = ['major'];

    public function major(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Major::class);
    }
}
