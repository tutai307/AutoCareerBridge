<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Mối quan hệ nhiều-nhiều với Student (sinh viên đã ứng tuyển).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function applications(): BelongsToMany
    {
        // Thay 'applications' bằng tên bảng pivot thực tế của bạn nếu khác.
        // Thay 'job_id' và 'student_id' bằng tên cột khóa ngoại thực tế nếu khác.
        return $this->belongsToMany(Student::class, 'applications', 'job_id', 'student_id')
                    ->withTimestamps(); // Tùy chọn: nếu bảng pivot có cột created_at, updated_at
    }
}
