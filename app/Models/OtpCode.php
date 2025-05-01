<?php
namespace App\Models;

class OtpCode extends BaseModel
{
    protected $fillable = [
        "user_id",
        "code",
        "expired_at",
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
