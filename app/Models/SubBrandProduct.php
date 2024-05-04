<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SubBrandProduct extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly(['name', 'category_product_id', 'brand_product_id', 'status', 'created_by', 'updated_by'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} data")
            ->useLogName('sub_brand_product');
    }

    public function category(){
        return $this->belongsTo(CategoryProduct::class, 'category_product_id', 'id');
    }

    public function brand(){
        return $this->belongsTo(BrandProduct::class, 'brand_product_id', 'id');
    }

    public function deleted_actor(){
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }

    public function created_actor(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_actor(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
