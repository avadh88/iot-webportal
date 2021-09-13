<?php

namespace App\Models\ebl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = 'user';
    protected $fillable = ['username','email','first_name','last_name','role','password','repeat_password'];
}


