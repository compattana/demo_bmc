<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModelItem extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function pm()
    {
        return $this->belongsTo(PreventiveMaintenance::class, 'pm_id', 'id');
    }

    public function productModel()
    {
        return $this->belongsTo(ProductModel::class, 'product_model_id', 'id');
    }
}
