<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'screen_size',
        'screen_resolution',
        'screen_type',
        'cpu_cores',
        'cpu_frequency',
        'ram',
        'internal_storage',
        'battery_capacity',
        'back_camera_resolution',
        'front_camera_resolution',
        'max_video_resolution',
        'operating_system',
        'connector',
        'network_connection',
        'product_id'
    ];
}
