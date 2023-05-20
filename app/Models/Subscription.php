<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'products',
        'day',
        'from',
        'to',
        'expired_date'
    ];
    protected $casts = [
        'products' => 'array'
    ];
}
