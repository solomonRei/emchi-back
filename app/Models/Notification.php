<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'status',
        'user_id'
    ];

    public function records()
    {
        return $this->hasOne(Record::class, 'notification_id', 'id');
    }

    public function services()
    {
        return $this->hasOne(Service::class, 'notification_id', 'id');
    }

}
