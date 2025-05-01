<?php
namespace App\Models;

class Lesson extends BaseModel
{
    protected $fillable = [
        'name',
        'duration',
        'link',
        'course_id',
        'is_active',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
