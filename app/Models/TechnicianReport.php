<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TechnicianReport extends Model implements HasMedia
{
    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;

    const STATUS_FINISHED = 'finished';
    const STATUS_UNFINISHED = 'unfinished';

    const TYPE_MAINTENANCE_PM = 'maintenance_pm';
    const TYPE_NO_CONTRACT = 'no_contract';
    const TYPE_EMERGENCY = 'emergency';
    const TYPE_INSTALL = 'install';
    const TYPE_REWORK = 'rework';
    const TYPE_OTHER = 'other';

    const STATUS_REPORT_APPROVE = 'approved';
    const STATUS_REPORT_NO_APPROVE = 'no_approve';
    const STATUS_REPORT_IN_PROGRESS = 'in_progress';
    const STATUS_REPORT_WARRANTY = 'warranty';
    const STATUS_REPORT_WAIT_PRICE = 'wait_price';
    const STATUS_REPORT_REWORK = 'rework';
    const STATUS_REPORT_JOB_CLOSE = 'job_close';
    const STATUS_REPORT_OTHER = 'other';

    const status = [
        'approved' => 'อนุมัติแล้ว',
        'no_approve' => 'ยังไม่อนุมัติ',
        'in_progress' => 'กำลังดำเนินการ',
        'warranty' => 'Warranty',
        'wait_price' => 'รอเสนอราคา',
        'rework' => 'Rework',
        'job_close' => 'Job Close',
        'other' => 'อื่นๆ'
    ];

    const type = [
        'maintenance_pm' => 'PM',
        'no_contract' => 'นอก Contract',
        'emergency' => 'ฉุกเฉิน',
        'install' => 'ติดตั้ง',
        'rework' => 'Rework',
        'other' => 'อื่นๆ',
    ];

    public function maintenanceSchedule()
    {
        return $this->belongsTo(MaintenanceSchedule::class, 'maintenance_schedule_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'technician_id', 'id');
    }

    public function agreementItem()
    {
        return $this->belongsTo(AgreementItem::class, 'agreement_item_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productSerial()
    {
        return $this->belongsTo(ProductSerial::class, 'product_serial_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function dryerItem()
    {
        return $this->hasMany(DryerItem::class);
    }

    public function compressorItem()
    {
        return $this->hasMany(CompressorItem::class);
    }

    public function technicianPm()
    {
        return $this->hasMany(TechnicianPm::class, 'report_id', 'id');
    }

    public function partItem()
    {
        return $this->hasMany(PartChangeItem::class);
    }

    public function technicianReportItems()
    {
        return $this->hasMany(TechnicianReportItem::class);
    }


    // register media collection
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->nonQueued();

    }

    // register media collection
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('signed')->singleFile();
        $this->addMediaCollection('images');
    }
}
