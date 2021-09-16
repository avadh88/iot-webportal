<?php

namespace App\Models\ebl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = 'login';
    protected $fillable = ['username','password'];
}
