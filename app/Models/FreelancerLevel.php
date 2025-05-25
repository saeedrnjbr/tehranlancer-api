<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerLevel extends Model
{

    protected $appends = ["nick_name", "avatar_link", "level_result_fa"];

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'avatar',
        'level',
        'level_result',
        'courses',
        'result',
        'user_id',
        'school',
    ];


    public function getAvatarLinkAttribute()
    {
        return url("/") . "/uploads/" . $this->avatar;
    }

    public function getNickNameAttribute(){
        return $this->first_name . " ". $this->last_name;
    }

    public function getLevelResultFaAttribute(){
        
        if( $this->level_result == "basic" ){
            return "پایه";
        }

        if( $this->level_result == "junior" ){
            return "جونیور";
        }

        if( $this->level_result == "expert_junior" ){
            return "جونیور ارشد";
        }

        if( $this->level_result == "senior" ){
            return "سینیور";
        }

    }

}
