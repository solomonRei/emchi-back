<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends BaseModel
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

    public function service()
    {
        return $this->hasMany(Service::class, 'order_id', 'order_id');
    }
}
