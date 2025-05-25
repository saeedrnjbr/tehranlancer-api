<?php

namespace App\Models;


class Course extends BaseModel
{
    protected $appends = ["image_link"];

    protected $fillable = [
        'name',
        'content',
        'description',
        'course_category_id',
        'image',
        'level',
        'is_active',
    ];

    public function course_category()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function getImageLinkAttribute()
    {
        return url("/") . "/uploads/" . $this->image;
    }
}
