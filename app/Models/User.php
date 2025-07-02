<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     // Appointments where this user is the client
    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    // Appointments where this user is the host
    public function hostAppointments()
    {
        return $this->hasMany(Appointment::class, 'host_id');
    }
}
