<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Resume extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'resumes';
    protected $fillable = ['student_id', 'title', 'file_path', 'is_main'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'id', 'resume_id');
    }
}
