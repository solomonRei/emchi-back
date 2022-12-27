<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'name',
        'number',
        'user_id',
        'order_id',
        'clinicId',
        'doctor_id',
        'entryTypeId',
        'kind',
        'parentEntryId',
        'price',
        'amount',
        'sum',
        'finalSum',
        'date',
        'status',
        'description',
        'testimony',
        'restriction',
        'result'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'service_id' => 'integer',
        'order_id' => 'integer',
        'clinicId' => 'integer',
        'doctor_id' => 'integer',
        'entryTypeId' => 'integer',
        'price' => 'double',
        'sum' => 'double',
        'finalSum' => 'double',
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

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'doctor_id', 'doctor_id');
    }

//    public function payments()
//    {
//        return $this->hasMany(Payments::class, 'order_id', 'order_id');
//    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
