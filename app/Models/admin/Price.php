<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Location;
use App\Models\admin\LocationDetail;
use App\Models\admin\Taxi;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'range',
        'price',
        'trip',
        'car_id',
        'location_id'
    ];

    public function taxi()
    {
        return $this->belongsTo(Taxi::class, 'car_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
