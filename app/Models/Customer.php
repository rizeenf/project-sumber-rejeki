<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly(['code', 'name', 'phone', 'photo', 'address', 'LA', 'LO',
            'area', 'subarea', 'status_registration', 'type', 'banner', 'branch_id', 'user_id',
            'status', 'created_by', 'updated_by', 'deleted_by'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} data")
            ->useLogName('customer');
    }

    protected $fillable = [
        'code',
        'name',
        'phone',
        'address',
        'LA',
        'LO',
        'area',
        'subarea',
        'status_registration',
        'type',
        'banner',
        'branch_id',
        'user_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function deploy_branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function belongs_user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
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

    public function store_buy(){
        return $this->hasMany(DetailOutletVisit::class, 'customer_id', 'id');
    }
}
