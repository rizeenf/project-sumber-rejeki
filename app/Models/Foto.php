<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Foto extends Model
{
    use HasFactory,LogsActivity;

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly(['header_visit_id', 'file_name', 'file_size', 'type'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} data")
            ->useLogName('foto');
    }

    protected $fillable = [
        'header_visit_id',
        'file_name',
        'file_size',
        'type'
    ];

    public function headerVisit(){
        return $this->belongsTo(HeaderVisit::class, 'header_visit_id', 'id');
    }
}
