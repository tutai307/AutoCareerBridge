<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaboration extends Model
{
    use HasFactory, SoftDeletes;
     protected $guarded = [];

    public $date = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Quan hệ với University
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
