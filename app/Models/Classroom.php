<?php

namespace App\Models;

use Illuminate\Support\Carbon;

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

    public function teachers()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Eloquent: Query Scopes
     *
     */
    public function scopeValidateTeacherClassesNoOverlap($filter, $id, $startTimestamp, $endTimestamp)
    {
        $formatStartTimestamp = Carbon::createFromFormat('d/m/Y H:i', $startTimestamp)->format('Y-m-d H:i:s');
        $formatEndTimestamp = Carbon::createFromFormat('d/m/Y H:i', $endTimestamp)->format('Y-m-d H:i:s');

        return $filter->with('teachers')->where('user_id', $id)
            ->where(function ($filter) use ($formatStartTimestamp, $formatEndTimestamp) {
                $filter->whereBetween('start_timestamp', [$formatStartTimestamp, $formatEndTimestamp])
                    ->orWhereBetween('end_timestamp', [$formatStartTimestamp, $formatEndTimestamp]);
            });
    }

    public function scopeValidateTeacherClassesNoFourHoursDay($filter, $id)
    {
        $classroomsTheTeacher = $filter->with('teachers')->where('user_id', $id)->get();

        $hours = 0;

        foreach ($classroomsTheTeacher as $value) {
            $hours += Carbon::parse($value->end_timestamp)->diffInMinutes($value->start_timestamp);
        }

        return ($hours / 60) >= 4;
    }

    // public function scopeValidateTeacherClassesNoTwoDiciplineDay($filter, $id)
    // {
    //     $classroomsTheTeacher = $filter->with('teachers')->where('user_id', $id)->get();
    // }
}
