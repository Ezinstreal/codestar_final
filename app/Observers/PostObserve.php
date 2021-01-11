<?php
namespace App\Observers;
use App\Notifications\NewPost;
use App\Models\Post;

class PostObserve
{
    // public function created(Post $post)
    // {
    //     $user = $post->users->first();
    //     foreach ($user->followers as $follower) {
    //         $follower->notify(new NewPost($user, $post));
    //     }
    // }
}
