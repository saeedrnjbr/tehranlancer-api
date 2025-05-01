<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeZone;


class Event extends BaseModel
{

    protected $appends = ["expired_at_fa", "image_link", "state"];

    protected $fillable = [
        'name',
        'image',
        'expired_at',
        'event_category_id',
        'is_active',
    ];

    public function getExpiredAtFaAttribute()
    {
        return \Morilog\Jalali\Jalalian::forge($this->expired_at, new DateTimeZone("Asia/Tehran"))->format('Y/m/d');
    }


    public function getStateAttribute(){

        if($this->expired_at < Carbon::now()->getTimestamp()){
            return "expired";
        }


        return "processing";
    }

    public function event_category()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function setExpiredAtAttribute($value){

        $to = explode("/", $value);

        $time = Carbon::createFromDate(implode("/", \Morilog\Jalali\CalendarUtils::toGregorian($to[0], $to[1], $to[2])));

        $this->attributes["expired_at"] = $time->getTimestamp()     ;
    
    }

    public function getImageLinkAttribute()
    {
        return url("/") . "/uploads/" . $this->image;
    }
}
