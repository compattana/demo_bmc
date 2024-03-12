<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianReportItem extends Model
{
    use HasFactory;

    public function technicianReport(){
        return $this->belongsTo(TechnicianReport::class,'technician_report_id', 'id');
    }
}
