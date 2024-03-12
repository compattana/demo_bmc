<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartChangeItem extends Model
{
    use SoftDeletes;
    use HasFactory;

    const STATUS_PRESENT = 'present';
    const STATUS_FUTURE = 'future';

    public function technicianReport(){
        return $this->belongsTo(TechnicianReport::class,'technician_report_id','id');
    }

    public function productPart(){
        return $this->belongsTo(ProductPart::class,'product_part_id','id');
    }
}
