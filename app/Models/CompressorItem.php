<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompressorItem extends Model
{
    use HasFactory;

    public function technicianReport(){
        return $this->belongsToMany(TechnicianReport::class,'technician_report_id','id');
    }

    public function compressor(){
        return $this->belongsToMany(Compressor::class,'compressor_id','id');
    }
}
