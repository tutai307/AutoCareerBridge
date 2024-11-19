<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hiring extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'company_id',
        'full_name',
        'avatar_path',
    ];
    protected $dates = ['deleted_at'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
