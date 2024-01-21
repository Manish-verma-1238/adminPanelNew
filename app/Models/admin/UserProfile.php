<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'users_profiles';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'panel_name',
        'panel_logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserProfile(array $data)
    {
        return $this->where($data)->first();
    }
}
