<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiStartTime extends Model
{
    protected $table = 'api_start_time';

    protected $fillable = [
        'api_start_time',
    ];
}
