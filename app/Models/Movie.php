<?php
namespace App\Models;

class Movie extends BaseModel
{

    protected $appends = ["image_link"];

    protected $fillable = [
        'name',
        'age_group',
        'genre_id',
        'link',
        'thumbnail_link',
        'content',
        'description',
        'image',
        'is_active',
    ];

    public function getImageLinkAttribute()
    {
        return url("/") . "/uploads/" . $this->image;
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
}
