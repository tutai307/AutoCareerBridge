<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'district_id'];

    // Mối quan hệ N-1 với District
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
