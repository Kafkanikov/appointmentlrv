<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'tb_appointments';
    protected $primaryKey = 'appointment_id';

    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'title',
        'description',
        'client_id',
        'host_id',
        'location_id',
        'start_time',
        'end_time',
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
