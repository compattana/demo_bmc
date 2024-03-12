<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    static function getTypeArray()
    {
        return [
            'air_circuit' =>'Air Circuit',
            'oil_circuit' =>'Oil Circuit',
            'mot' =>'Mot',
            'control_system' =>'Control System',
            'general' =>'General'
        ];
    }

    public function inspectionItems()
    {
        return $this->hasMany(InspectionItem::class);
    }

}
