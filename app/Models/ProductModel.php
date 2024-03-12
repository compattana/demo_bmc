<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use SoftDeletes;
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'title',
        'type',
        'limit_value',
        'status',
        'product_id'
    ];

    static function getTypeArray()
    {
        return [
            'temperature' =>'Temperature [°C]',
            'pressure' =>'Pressure [BAR]',
            'voltage' =>'Voltage [V]',
            'current_load' =>'Current Load [A]',
            'current_unload' =>'Current Unload [A]'
        ];
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function items()
    {
        return $this->hasMany(ProductModelItem::class);
    }
}
