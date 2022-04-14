<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Classroom extends BaseModel
{
    use CascadeSoftDeletes;

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
        'startTimestampDate',
        'endTimestampDate',
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

    protected $cascadeDeletes = [
        'students'
    ];

    /**
     * Eloquent: Mutators & Casting
     *
     */
    public function setStartTimestampAttribute($value)
    {
        $this->attributes['start_timestamp'] = Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i:s');
    }

    public function getStartTimestampAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    public function setEndTimestampAttribute($value)
    {
        $this->attributes['end_timestamp'] = Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i:s');
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

    public function getStartTimestampDateAttribute()
    {
        $startHours = $this->attributes['start_timestamp'];

        return date('d/m/Y H:i', strtotime($startHours));
    }

    public function getEndTimestampDateAttribute()
    {
        $endHours = $this->attributes['end_timestamp'];

        return date('d/m/Y H:i', strtotime($endHours));
    }

    /**
     * Eloquent: Relationships
     *
     */
    public function students()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsTo(User::class);
    }
}
