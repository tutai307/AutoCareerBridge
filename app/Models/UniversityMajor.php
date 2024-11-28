<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniversityMajor extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['university_id', 'major_id'];
    public $incrementing = false;
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
