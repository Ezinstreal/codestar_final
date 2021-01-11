<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','status','status2'];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
