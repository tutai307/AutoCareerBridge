<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    // protected $with = ['user'];

    protected $guarded = [];

    protected $appends = ['email'];

    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }

    public function getEmailAttribute()
    {
        return $this->user ? $this->user->email : null;
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'university_majors', 'university_id', 'major_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function collaborations()
    {
        return $this->belongsToMany(Company::class, 'collaborations', 'university_id', 'company_id');
    }

    public function universityMajors()
    {
        return $this->hasMany(UniversityMajor::class);
    }
    public function workshops()
    {
        return $this->hasMany(WorkShop::class);
    }
    public function universityJobs()
    {
        return $this->hasMany(UniversityJob::class);
    }
}
