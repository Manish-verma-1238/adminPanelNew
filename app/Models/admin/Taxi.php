<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\LocationDetail;
use App\Models\admin\Price;
use App\Models\admin\Location;

class Taxi extends Model
{
    use HasFactory;

    protected $table = 'taxis';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'bags',
        'price',
    ];

    public function rangePrice()
    {
        return $this->hasMany(Price::class, 'car_id');
    }
}
