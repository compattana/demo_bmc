<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'organization_name',
        'status'
    ];

    public function agreements(){
        return $this->hasMany(Agreement::class);
    }

    public function technicianReport(){
        return $this->hasMany(TechnicianReport::class);
    }

    public function schedule()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }
}
