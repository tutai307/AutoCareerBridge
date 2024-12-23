<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'university_id',
        'student_code',
        'major_id',
        'name',
        'slug',
        'avatar_path',
        'email',
        'phone',
        'gender',
        'entry_year',
        'graduation_year',
        'description',
    ];
    
    public function major(){
        return $this->belongsTo(Major::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'student_skills');
    }
}
