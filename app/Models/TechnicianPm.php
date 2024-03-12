<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianPm extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'technician_id','id');
    }

    public function schedule(){
        return $this->belongsTo(MaintenanceSchedule::class, 'maintenance_schedule_id','id');
    }

    public function report(){
        return $this->belongsTo(TechnicianReport::class, 'report_id','id');
    }
}
