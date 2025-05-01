<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRequest extends Model
{
    protected $fillable = [
        'mobile',
        'first_name',
        'last_name',
        'alternative_mobile',
        'level',
        'event_id',
    ];
}
