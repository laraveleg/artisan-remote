<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guid',
        'public_key',
        'secret_key',
        'name',
        'url_listener',
    ];

    protected $casts = [
        'artisan_orders' => 'array',
    ];
}
