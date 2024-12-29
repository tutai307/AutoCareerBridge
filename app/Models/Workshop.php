<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShop extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function university()
    {
        return $this->hasOne(University::class, 'id', 'university_id');
    }

    public function companyWorkshops(){
        return $this->hasMany(CompanyWorkshop::class, 'workshop_id', 'id');
    }

}

