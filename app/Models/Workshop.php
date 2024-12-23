<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workshop extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function university()
    {
        return $this->hasOne(University::class, 'id', 'university_id');
    }
}
