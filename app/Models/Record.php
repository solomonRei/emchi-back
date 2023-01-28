<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Record extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'record_id',
        'user_id',
        'clinic_id',
        'order_id',
        'doctor_id',
        'status',
        'call_confirmation_status',
        'appointment_type',
        'date',
        'time',
        'duration',
        'note',
        'notification_id'
    ];

    public function checkToday(): int
    {
        $date = Carbon::parse($this->date);
        return $date->isToday() ? 1 : 0;
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'doctor_id', 'doctor_id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'clinic_id');
    }

}
