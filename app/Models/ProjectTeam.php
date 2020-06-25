<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'projet_id',
        'role',
    ];

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'projet_id');
    }
}
