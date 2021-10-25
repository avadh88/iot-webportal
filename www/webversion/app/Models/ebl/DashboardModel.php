<?php

namespace App\Models\ebl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{
    use HasFactory;
    protected $connection = "mysql";
    protected $table = 'permenent_device';
    protected $fillable = ['company_name','device_name','serial_number'];
}
