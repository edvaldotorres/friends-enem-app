<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Discipline extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'disciplines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Eloquent: Query Scopes
     *
     */
    public function scopeDisciplines(Builder $query)
    {
        $query->where('id', 0)->orderBy('name', 'ASC');
    }
}
