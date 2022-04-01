<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'teacher_admin',
        'teacher',
        'name',
        'nickname',
        'document',
        'genre',
        'birth_date',
        'zipcode',
        'telephone',
        'whatsapp',
        'graduation',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Eloquent: Mutators & Casting
     *
     */

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = (!empty($value) ? $this->clearField($value) : null);
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = (!empty($value) ? $this->convertStringToDate($value) : null);
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = (!empty($value) ? $this->clearField($value) : null);
    }

    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = (!empty($value) ? $this->clearField($value) : null);
    }

    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            unset($this->attributes['password']);
            return;
        }

        $this->attributes['password'] = Hash::make($value);
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    private function clearField(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }

    /**
     * Eloquent: Relationships
     *
     */

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class)->withTimestamps();
    }
}
