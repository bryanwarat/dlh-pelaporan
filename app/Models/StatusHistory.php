<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $fillable = [
        'complaint_id',
        'status',
        'note',
        'status_by',
    ];
}
