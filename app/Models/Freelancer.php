<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Freelancer extends BaseModel
{
    use SoftDeletes;

    protected $appends = ["nick_name", "avatar_link"];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'skills',
        'avatar',
        'about',
        'favorites',
        'is_active',
    ];

   
    public function getAvatarLinkAttribute()
    {
        return url("/") . "/uploads/" . $this->avatar;
    }

    public function getNickNameAttribute(){
        return $this->first_name . " ". $this->last_name;
    }
}
