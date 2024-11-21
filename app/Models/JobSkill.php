<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;

    public function skills(){
        return $this->belongsTo(Skill::class);
    }

    public function jobs(){
        return $this->belongsTo(Job::class);
    }
}
