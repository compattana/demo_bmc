<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementItem extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'agreement_id',
        'product_id',
        'product_serial_id',
    ];

    public function agreement(){
        return $this->belongsTo(Agreement::class,'agreement_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function productSerial(){
        return $this->belongsTo(ProductSerial::class,'product_serial_id','id');
    }

    public function technicianReports()
    {
        return $this->hasMany(TechnicianReport::class);
    }
}
