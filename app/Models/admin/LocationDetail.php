<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Location;
use App\Models\admin\Price;

class LocationDetail extends Model
{
    use HasFactory;

    protected $table = 'location_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
