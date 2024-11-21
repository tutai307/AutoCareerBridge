<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'province_id'];

    // Mối quan hệ N-1 với Province
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // Mối quan hệ 1-N với Ward
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
