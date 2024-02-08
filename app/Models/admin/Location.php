<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\LocationDetail;
use App\Models\admin\Price;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'priority'
    ];

    public function details()
    {
        return $this->hasMany(LocationDetail::class, 'location_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'location_id');
    }
}
