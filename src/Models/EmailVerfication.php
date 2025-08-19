<?php

namespace Mughal\AdminAuth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerfication extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'pin',
    ];
}
