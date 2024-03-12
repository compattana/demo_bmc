<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPart extends Model
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
    ];

    static function getTypeArray()
    {
        return [
            'air_circuit' =>'Air Circuit',
            'oil_circuit' =>'Oil Circuit',
            'mot' =>'Mot',
            'control_system' =>'Control System',
            'general' =>'General',];
    }

    public function products(){
        return $this->belongsToMany(Product::class,'product_has_parts','part_id','product_id');
    }


    public function product(){
        return $this->belongsTo(ProductHasPart::class);
    }

    public function partChangeItem(){
        return $this->hasMany(PartChangeItem::class);
    }
}
