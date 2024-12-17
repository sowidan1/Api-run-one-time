<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeDelete extends Model
{
    protected $table = "time_deletes";

    protected $fillable = [
        'time_unit',
        'time_value',
        'start_time',
        'end_time',
    ];
}
