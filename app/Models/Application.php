<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
     use HasFactory;

    protected $fillable = [
        'student_id',
        'job_id',
        'cv_path',
        'cover_letter',
        'status',
    ];

    // Quan hệ với User
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Quan hệ với Job (nếu có)
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function resume()
    {
        return $this->hasOne(Resume::class);
    }
}
