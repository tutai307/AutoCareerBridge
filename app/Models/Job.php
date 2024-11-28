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
        'hiring_id',
        'end_date',
        'detail',
        'status',
        'major_id',
    ];

    public $date = ['deleted_at'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function hiring()
    {
        return $this->belongsTo(Hiring::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills');
    }

    public function universities()
{
    return $this->belongsToMany(University::class, 'job_university');
}
}
