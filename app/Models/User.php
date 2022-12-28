<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'secondName',
        'login',
        'email',
        'password',
        'birthdate',
        'phone',
        'idPolis',
        'inn',
        'snils',
        'workplace',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'login_at' => 'datetime'
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

    public function getNotifications($type, $status = 0)
    {
        return $this->notifications->where('status', $status)->where('type', $type);
    }

    public function getNotificationsAllCount($status = 0)
    {
        return $this->notifications->where('status', $status)->count();
    }


    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function records()
    {
        return $this->hasMany(Records::class, 'user_id', 'user_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'user_id', 'user_id');
    }

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'user_id', 'user_id');
    }
}
