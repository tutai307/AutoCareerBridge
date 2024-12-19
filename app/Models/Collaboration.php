<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaboration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'university_id',
        'company_id',
        'title',
        'created_by',
        'status',
        'response_message',
        'content',
        'end_date',
        'created_by',
    ];

    public $date = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    // Quan hệ với University
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
