<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintFile extends Model
{
    protected $fillable = [
        'complaint_id',
        'complaint_file',
    ];
}
