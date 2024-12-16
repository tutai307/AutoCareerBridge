<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'user_id',
        'end_date',
        'detail',
        'status',
        'major_id',
        'company_id'
    ];

    public $date = ['deleted_at'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills');
    }

    public function universities()
    {
        return $this->belongsToMany(University::class, 'university_jobs');
    }

    public function universityJobs()
    {
        return $this->hasMany(UniversityJob::class);
    }
}
