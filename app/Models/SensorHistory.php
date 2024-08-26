<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorHistory extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'sensor_histories';

    // Define the fillable fields
    protected $fillable = [
        'site_code',
        'factory_code',
        'ph',
        'flow',
        'total_debit',
        'total_credit',
        'created_at',
        'updated_at'
    ];
}
