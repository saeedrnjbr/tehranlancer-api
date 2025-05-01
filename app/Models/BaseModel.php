<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $appends = ["created_at_fa"];

    public function getCreatedAtFaAttribute()
    {
        return \Morilog\Jalali\Jalalian::forge($this->created_at)->format('%B %d، %Y');
    }

}
