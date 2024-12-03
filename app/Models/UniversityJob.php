<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'university_id',
        'status',
    ];

    // Quan hệ với model Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'jobs_id');
    }

    // Quan hệ với model University
    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
}
