<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function universityMajors()
    {
        return $this->hasMany(UniversityMajor::class);
    }

    public function field(){
        return $this->belongsTo(Field::class, 'field_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_majors', 'major_id', 'company_id')
            ->withPivot('created_at') ;
    }

}
