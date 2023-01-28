<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceAll extends BaseModel
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

}
