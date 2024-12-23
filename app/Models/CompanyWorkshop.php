<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyWorkshop extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'workshop_id',
        'status',
    ];

    public function workshops(){
        return $this->belongsTo(WorkShop::class, 'workshop_id', 'id');
    }

    public function companies(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    
}
