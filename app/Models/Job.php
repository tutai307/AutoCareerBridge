<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

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
}
