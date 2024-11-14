<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'province_id',
        'district_id',
        'ward_id',
        'specific_address',
        'university_id',
        'company_id',
        'job_id',
    ];
    public $date = [
        'deleted_at',
    ];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

}
