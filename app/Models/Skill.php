<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_skills');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_skills');
    }
}
