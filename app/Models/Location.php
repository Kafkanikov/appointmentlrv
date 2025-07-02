<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'tb_locations';
    protected $primaryKey = 'location_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'description',
        'address',
        'floor',
        'capacity',
        'equipment',
        'is_active',
    ];

    protected $casts = [
        'equipment' => 'array',
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    // Relationship: A location can have many appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'location_id');
    }

    // Scope for active locations
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
