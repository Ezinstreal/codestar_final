<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow_id', 'user_id')
                    ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'user_id', 'follow_id')
                    ->withTimestamps();
    }

    public function posts(){
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function savedPosts(){
        return $this->belongsToMany(Post::class,'storages','user_id','post_id')->withTimestamps();
    }
    public function comments(){
        return $this->belongsToMany(Comment::class)->withTimestamps();
    }
    public function likedComments(){
        return $this->belongsToMany(Comment::class,'comment_like','user_id','comment_id')->withTimestamps();
    }
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }
    public function hasRole($roles){
        if($this->roles()->where('name', $roles)->first()){
            return true;
        }
        return false;
    }
    public function profile(){
        return $this->hasOne(Profile::class);
    }

}
