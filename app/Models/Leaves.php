<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Leaves extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'leave_date',
        'from_time',
        'to_time',
        'description',
        'status',
        'approved_by',
        'rejected_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getShamsiDateAttribute()
    {
        if (!$this->leave_date) {
            return '-';
        }

        return Jalalian::fromDateTime($this->leave_date)
            ->format('Y/m/d');
    }

}
