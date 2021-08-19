<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Permission extends Model
{
    use HasFactory,HasApiTokens;
    // protected $table      = 'permissions';
    protected $fillable   = ['permission_name'];

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
