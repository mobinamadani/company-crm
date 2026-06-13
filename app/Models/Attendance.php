<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getShamsiDateAttribute()
    {
        return Jalalian::fromDateTime($this->date)
            ->format('Y/m/d');
    }

    public function getWorkHoursAttribute()
    {
        if (!$this->check_out) {
            return '-';
        }

        return Carbon::parse($this->check_in)
            ->diff(
                Carbon::parse($this->check_out)
            )
            ->format('%H:%I');
    }
}
