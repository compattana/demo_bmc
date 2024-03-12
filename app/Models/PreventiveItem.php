<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreventiveItem extends Model
{
    use HasFactory;

    public function preventive(){
        return $this->belongsTo(PreventiveMaintenance::class,'preventive_id','id');
    }

}
