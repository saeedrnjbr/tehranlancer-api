<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerRequest extends Model
{
    protected $fillable = [
        "owner",
        "mobile",
        "address",
        "stack",
        "project_file",
        "project_name",
        "project_description",
        "freelancer_id",
    ];
}
