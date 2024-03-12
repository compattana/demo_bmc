<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Agreement extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const CONTRACT_MONTH = 'month';
    const CONTRACT_YEAR = 'year';
    const CONTRACT_YEAR_FREE = 'year_free';

    protected $fillable = [
      'customer_id',
      'title',
      'code',
      'status'
    ];

    const status = [
        'success' => 'ยังไม่หมดอายุ',
        'warning' => 'ใกล้หมดอายุ',
        'danger' => 'หมดอายุ',
    ];

    const type = [
        'month' => 'รายเดือน',
        'year' => 'รายปี',
        'year_free' => 'รายปี (แถม)',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function items(){
        return $this->hasMany(AgreementItem::class);
    }

    public function schedules(){
        return $this->hasMany(MaintenanceSchedule::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();

        $this->addMediaConversion('thumb-cropped')
            ->crop('crop-center', 400, 400);
    }
}
