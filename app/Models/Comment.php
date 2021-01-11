<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }
    public function usersLiked(){
        return $this->belongsToMany(User::class,'comment_like','comment_id','user_id')->withTimestamps();
    }
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
