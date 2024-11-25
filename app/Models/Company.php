<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'avatar_path',
        'map',
        'phone',
        'size',
        'tax_code',
        'image_file',
        'description',
        'about',
    ];

    public function hirings()
    {
        return $this->hasMany(Hiring::class, 'company_id', 'id');
    }
    public function collaborations()
    {
        return $this->belongsToMany(University::class, 'collaborations', 'company_id', 'university_id');
    }
    public function companyworkshops()
    {
        return $this->belongsToMany(Job::class, 'company_workshops', 'company_id', 'workshop_id');
    }
    public $date = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
