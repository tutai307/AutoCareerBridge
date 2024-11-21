<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'universities';

    // Các trường có thể gán đại trà (mass assignable)
    protected $fillable = [
        'name', 'slug', 'avatar_image', 'map', 'description', 'about', 
        'active', 'website_link'
    ];

    public $date = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address(){
        return $this->belongsTo(Address::class, 'id');
    }
}
