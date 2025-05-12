<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Student extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

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
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName(){
        return 'student_code';
    }

    public function major(){
        return $this->belongsTo(Major::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'student_skills');
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function university(){
        return $this->belongsTo(University::class);
    }
}
