<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PreventiveMaintenance extends Model implements HasMedia
{
    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;

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

    public function maintenanceSchedule(){
        return $this->belongsTo(MaintenanceSchedule::class,'maintenance_schedule_id','id');
    }

    public function items()
    {
        return $this->hasMany(ProductModelItem::class);
    }

    public function preventiveItem()
    {
        return $this->hasMany(PreventiveItem::class);
    }

    public function inspectionItems()
    {
        return $this->hasMany(InspectionItem::class);
    }
}
