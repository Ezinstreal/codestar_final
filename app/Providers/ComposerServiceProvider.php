<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Place;
use App\Models\Tag;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if(Auth::user()){
                $id = Auth::user()->id;
                $user_me = User::findOrFail($id);

                if(count($user_me->notifications->where('read_at',null))>5){
                    $notifications = $user_me->notifications->where('read_at',null);
                }else{
                    $notifications = $user_me->notifications()->limit(6)->get();
                }

                $view->with('notifications',$notifications);
                $view->with('user_me',$user_me);
            }
        });

        view()->composer('frontend.posts.index', function ($view) {
            $view->with('place_me',Place::where('status2',1)->get());
        });
        view()->composer('frontend.posts.index', function ($view) {
            $view->with('tag_me',Tag::where('status2',1)->get());
        });
    }
}
