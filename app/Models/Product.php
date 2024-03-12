<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $table = 'products';
    protected $fillable = [
        'title',
        'code',
        'status'
    ];

    public function productSerials(){
        return $this->hasMany(ProductSerial::class);
    }

    public function productModels(){
        return $this->hasMany(ProductModel::class);
    }

    public function items(){
        return $this->hasMany(AgreementItem::class);
    }

    public function product_parts(){
        return $this->belongsToMany(ProductPart::class,'product_has_parts','product_id','part_id');
    }

    public function productHasPart(){
        return $this->hasMany(ProductHasPart::class);
    }

    public function technicianReport(){
        return $this->hasMany(TechnicianReport::class);
    }
}
