<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $primaryKey ='notificationId';

    protected $fillable=[
        'notificationMessage',
        'notificationTitle',
        'notificationStatus',
    ];

}
