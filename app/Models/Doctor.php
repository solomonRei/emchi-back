<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'name',
        'surname',
        'secondName',
        'currentClinicId',
        'phone',
        'location',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'doctor_id' => 'integer'
    ];

    // Form FIO format
    protected function fio(): Attribute
    {
        $surname = isset($this->surname[0]) ? mb_substr($this->surname, 0, 1) . "." : '';
        $secondName = isset($this->secondName[0]) ? mb_substr($this->secondName, 0, 1) . "." : '';
        $fio = $this->name . " " . $surname . $secondName;

        return Attribute::make(
            get: fn($value) => $fio
        );
    }
}
