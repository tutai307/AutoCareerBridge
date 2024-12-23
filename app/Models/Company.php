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
        'website_link',
        'is_active'
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
        return $this->hasMany(CompanyWorkshop::class);
    }
    public $date = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id'); // Đảm bảo khóa ngoại đúng.
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function fields()
    {
        return $this->belongsToMany(Field::class, 'company_fields', 'company_id', 'field_id');
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
