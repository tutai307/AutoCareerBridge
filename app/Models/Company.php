<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'avatar_path',
        'map',
        'phone',
        'size',
        'description',
        'about',

    ];

    public function hirings()
    {
        return $this->hasMany(Hiring::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);  
    }

}
