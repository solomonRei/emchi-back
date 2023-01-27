<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceAll extends Model
{
    use HasFactory;

    protected $table = 'services_all';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'services_all_id',
        'category_id',
        'clinics_id',
        'title',
        'price',
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


}
