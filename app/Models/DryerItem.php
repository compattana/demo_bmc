<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryerItem extends Model
{
    use HasFactory;

    public function technicianReport(){
        return $this->belongsToMany(TechnicianReport::class,'technician_report_id','id');
    }

    public function dryer(){
        return $this->belongsToMany(Dryer::class,'dryer_id','id');
    }
}
