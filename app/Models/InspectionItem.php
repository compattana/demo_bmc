<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionItem extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function pm(){
        return $this->belongsTo(PreventiveMaintenance::class, 'pm_id','id');
    }

    public function inspection(){
        return $this->belongsTo(Inspection::class,'inspection_id','id');
    }
}
