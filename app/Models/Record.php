<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Record extends Model
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

    private function rdate($param, $time = 0)
    {
        if ((int)$time === 0) {
            $time = time();
        }
        $MonthNames = array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
        if (!str_contains($param, 'M')) {
            return date($param, $time);
        }

        return date(str_replace('M', $MonthNames[date('n', $time) - 1], $param), $time);
    }

    protected function dateNormal(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->rdate('d M Y', strtotime($this->date))
        );
    }

    public function checkToday()
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
