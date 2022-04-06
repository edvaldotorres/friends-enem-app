<?php

namespace App\Models;

class Classroom extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classrooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'discipline_id',
        'start_timestamp',
        'end_timestamp',
        'vacancie',
        'status',
    ];

    /**
     * Eloquent: Mutators & Casting
     *
     */
    public function setStartTimestampAttribute($value)
    {
        $this->attributes['start_timestamp'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function getStartTimestampAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    public function setEndTimestampAttribute($value)
    {
        $this->attributes['end_timestamp'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function getEndTimestampAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    /**
     * Eloquent: Relationships
     *
     */
    public function students()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
