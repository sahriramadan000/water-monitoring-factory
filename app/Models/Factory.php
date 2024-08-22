<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;
    protected $fillable = ['factory_code','factory_name', 'factory_address', 'status'];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
