<?php

namespace App\Models;

class Slider extends BaseModel
{
 
    protected $appends = ["image_link"];
    
    protected $fillable = [
        'name',
        'link',
        'image',
        'is_active',
    ];

    public function getImageLinkAttribute()
    {
        return url("/") . "/uploads/" . $this->image;
    }
}
