<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function majors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Major::class);
    }
}
