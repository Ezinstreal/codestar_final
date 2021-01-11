<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','description','content','status','status2','type'];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function usersSavedPost(){
        return $this->belongsToMany(User::class,'storages','post_id','user_id')->withTimestamps();
    }
    public function places(){
        return $this->belongsToMany(Place::class)->withTimestamps();
    }
    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
