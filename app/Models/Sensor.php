<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    protected $fillable = ['site_id', 'sensor_ident', 'sensor_name', 'sensor_unit', 'decimal_point', 'status'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
