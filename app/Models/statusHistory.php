<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statusHistory extends Model
{
    protected $fillable = [
        'complaint_id',
        'status',
        'note',
        'status_by',
    ];
}
