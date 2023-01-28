<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'title',
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
        'result',
        'notification_id',
        'token_pdf'
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


    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'doctor_id', 'doctor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
