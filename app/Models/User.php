<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    use SoftDeletes;

    protected $appends = ["created_at_fa", "nick_name"];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_type',
        'is_active',
        'mobile',
        'password',
        'coupons'
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'user_type',
    ];

    public function getCreatedAtFaAttribute()
    {
        return \Morilog\Jalali\Jalalian::forge($this->created_at)->format('%B %d، %Y');
    }

    public function getNickNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function freelancer_level()
    {
        return $this->hasOne(FreelancerLevel::class);
    }
}
