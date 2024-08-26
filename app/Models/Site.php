<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $fillable = ['factory_id', 'site_code', 'topic', 'site_name', 'site_location', 'status'];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }
}
