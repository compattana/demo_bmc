<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSerial extends Model
{
    use SoftDeletes;
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $table = 'product_serials';
    protected $fillable = [
        'serial_name',
        'code',
        'serial_status',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function items(){
        return $this->hasMany(AgreementItem::class, 'product_serial_id', 'id');
    }

    public function technicianReport(){
        return $this->hasMany(TechnicianReport::class);
    }

}
