<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ScheduleOther extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function schedule(){
        return $this->belongsTo(MaintenanceSchedule::class, 'maintenance_schedule_id','id');
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
        $this->addMediaCollection('images');
    }

}
