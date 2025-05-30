<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRequest extends Model
{

    protected $appends = ["nick_name"];

    protected $fillable = [
        'mobile',
        'first_name',
        'last_name',
        'alternative_mobile',
        'level',
        'event_id',
    ];


        public function getNickNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

}
