<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly(['code', 'name', 'description', 'image', 
            'competitor', 'competitor_name', 'category_product_id', 'brand_product_id',
            'sub_brand_product_id', 'status', 'created_by', 'updated_by', 'deleted_by'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} data")
            ->useLogName('product');
    }

    protected $fillable = [
        'code',
        'name',
        'description',
        'competitor',
        'competitor_name',
        'category_product_id',
        'brand_product_id',
        'sub_brand_product_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category(){
        return $this->belongsTo(CategoryProduct::class, 'category_product_id', 'id');
    }

    public function brand(){
        return $this->belongsTo(BrandProduct::class, 'brand_product_id', 'id');
    }

    public function subBrand(){
        return $this->belongsTo(SubBrandProduct::class, 'sub_brand_product_id', 'id');
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
