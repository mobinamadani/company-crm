<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'text',
        'take_date',
        'status',
    ];

    protected $casts = [
        'take_date' => 'date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getShamsiDateAttribute()
    {
        if (!$this->take_date) {
            return '-';
        }

        return Jalalian::fromCarbon($this->take_date)
            ->format('Y/m/d');
    }
}
