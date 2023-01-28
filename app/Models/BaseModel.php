<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BaseModel extends Model
{
    protected function fio(): Attribute
    {
        $surname = isset($this->surname[0]) ? mb_substr($this->surname, 0, 1) . "." : '';
        $secondName = isset($this->secondName[0]) ? mb_substr($this->secondName, 0, 1) . "." : '';
        $fio = $this->name . " " . $surname . $secondName;

        return Attribute::make(
            get: fn($value) => $fio
        );
    }

    protected function rdate($param, $time = 0)
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
