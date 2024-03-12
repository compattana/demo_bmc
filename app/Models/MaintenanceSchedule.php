<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceSchedule extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'status',
    ];
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_PROCESS = 'process';
    const STATUS_SUCCESS = 'success';

    const TYPE_MAINTENANCE_PM = 'maintenance_pm';
    const TYPE_NO_CONTRACT = 'no_contract';
    const TYPE_EMERGENCY = 'emergency';
    const TYPE_INSTALL = 'install';
    const TYPE_REWORK = 'rework';
    const TYPE_OTHER = 'other';

    const STATUS_REPORT_APPROVE = 'approved';
    const STATUS_REPORT_NO_APPROVE = 'no_approve';
    const STATUS_WARRANTY = 'warranty';
    const STATUS_WAIT_PRICE = 'wait_price';
    const STATUS_REWORK = 'rework';
    const STATUS_JOB_CLOSE = 'job_close';
    const STATUS_OTHER = 'other';

    static function getTypeArray()
    {
        return [
            'no_contract' => 'นอก Contract',
            'emergency' => 'Emergency',
            'install' => 'ติดตั้ง',
            'rework' => 'Rework',
        ];
    }


    public function preventiveMaintenances()
    {
        return $this->hasMany(PreventiveMaintenance::class);
    }

    public function technicianReports()
    {
        return $this->hasMany(TechnicianReport::class);
    }

    public function scheduleOther()
    {
        return $this->hasMany(ScheduleOther::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function agreement()
    {
        return $this->belongsTo(Agreement::class, 'agreement_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'technician_id', 'id');
    }

    public function technicianPm()
    {
        return $this->hasMany(TechnicianPm::class);
    }
}
