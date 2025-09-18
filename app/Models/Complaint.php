<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'nik',
        'phone',
        'address',
        'email',
        'complaint',
        'complaint_link',
        'location',
        'lat',
        'long',
        'status',
    ];
}
