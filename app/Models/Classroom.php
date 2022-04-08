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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'week',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_timestamp' => 'datetime',
        'end_timestamp' => 'datetime',
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

    public function getWeekAttribute()
    {
        $week = $this->attributes['start_timestamp'];

        return date('D', strtotime($week));
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
