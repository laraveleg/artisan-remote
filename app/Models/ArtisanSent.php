<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtisanSent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projet_id',
        'guid',
        'artisan_sent',
        'artisan_output',
        'status'
    ];
}
