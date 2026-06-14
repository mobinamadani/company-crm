<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Task;
use App\Models\Attendance;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'mobile',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Tasks (many to many)
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    // Created tasks
    public function createTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }
}
