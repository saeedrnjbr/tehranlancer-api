<?php
namespace App\Models;

class CourseCategory extends BaseModel
{
    protected $fillable = [
        'name',
        'parent_id',
        'is_active',
    ];

    public function parent()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
