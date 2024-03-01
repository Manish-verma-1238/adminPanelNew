<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Taxi;

class LocalPrice extends Model
{
    use HasFactory;

    public function taxi()
    {
        return $this->belongsTo(Taxi::class, 'car_id');
    }
}
