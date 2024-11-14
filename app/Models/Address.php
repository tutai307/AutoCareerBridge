<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function university()
{
    return $this->belongsTo(University::class);
}
public function ward()
{
    return $this->belongsTo(Ward::class);
}

public function province()
{
    return $this->belongsTo(Province::class);
}

public function district()
{
    return $this->belongsTo(District::class);
}
}
