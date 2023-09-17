<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNavbar extends Model
{
    use HasFactory;
    protected $table = 'admin_navbars';

    public function childs() {
        return $this->hasMany(self::class, 'parent_id');
    }
}
