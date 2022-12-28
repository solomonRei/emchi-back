<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'customerId',
        'user_id',
        'notification_id',
        'customerType',
        'sum',
        'date',
        'finalSum',
        'orderPaidStatus',
        'clinic_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clinic_id' => 'integer',
        'order_id' => 'integer',
        'user_id' => 'integer',
        'customerId' => 'integer',
        'sum' => 'double',
        'finalSum' => 'double'
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
            get: fn($value) => $this->rdate('d M Y', strtotime($this->date))
        );
    }

    public function service()
    {
        return $this->hasMany(Service::class, 'order_id', 'order_id');
    }
}
