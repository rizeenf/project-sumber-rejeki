<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DetailOutletVisit extends Model
{
    use HasFactory,LogsActivity;

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly(['header_visit_id', 'sales_amount', 'customer_id', 'store_name', 'market_name', 'mark'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} data")
            ->useLogName('detail_outlet_visit');
    }

    public function header_visit(){
        return $this->belongsTo(HeaderVisit::class, 'header_visit_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
