<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_fields', 'field_id', 'company_id');
    }

    public function majors()
    {
        return $this->hasMany(Major::class);
    }
}
