<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\PostNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('type','1')->where('status','1')->orderBy('id','desc')->paginate(12);
        return view('frontend.posts.index',compact('posts'));
    }
    public function create(){
        return view('frontend.posts.create');
    }
    public function store(AddPostRequest $request){
        $tags = explode(',',$request->tags);
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title).'sa'.mt_rand(100,999);
        $post->description = $request->description;
        $post->content = $request->content;
        $post->status = 1;
        if($request->create_btn == 'save_btn'){
            $post->type = '2';
        }elseif($request->create_btn == 'post_btn'){
            $post->type = '1';
        }
        $post->save();
        $user = User::findOrFail(Auth::user()->id);

        $user->posts()->attach($post->id);
        foreach($tags as $item){
            $check = Tag::where('name',$item)->first();
            if($check == null){
                $tag = new Tag();
                $tag->name = $item;
                $tag->slug = Str::slug($item);
                $tag->status = 1;
                $tag->save();
                $post->tags()->attach($tag->id);
            }else{
                $post->tags()->attach($check->id);
            }
        }
        if($post->type == 2){
            return redirect()->route('posts.draft');
        }
        foreach ($user->followers as $follower) {
            $follower->notify(new PostNew($user, $post));
        }
        return redirect()->route('posts.index');
    }
    public function show($slug){
        $data = Post::where('slug',$slug)->firstOrFail();
        return view('frontend.posts.show',compact('data'));
    }
    public function tag($slug){
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->orderBy('id','desc')->paginate(12);
        return view('frontend.posts.index',compact('posts'));
    }

    public function getStorage(){
        $user = User::findOrFail(Auth::user()->id);
        $posts = $user->savedPosts()->paginate(12);
        return view('frontend.posts.index',compact('posts'));
    }

    public function draft(){
        $user = User::findOrFail(Auth::user()->id);
        $posts = $user->posts()->where('type',2)->get();
        return view('frontend.posts.draft',compact('posts'));
    }

    public function loadcomment(Request $request){
        $post_id = $request->post_id;
        $comments = Post::findOrFail($post_id)->comments;
        return response()->view('frontend.posts.comment',compact('comments'));
    }
    public function sendcomment(Request $request){
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();
        $comment->users()->attach(Auth::user()->id);
    }
    public function postStorage(Request $request){
        $post = Post::findOrFail($request->post_id);
        $post->usersSavedPost()->toggle(Auth::user()->id);
    }
    public function likecomment(Request $request){
        $comment = Comment::findOrFail($request->cmt_id);
        $comment->usersLiked()->toggle(Auth::user()->id);
    }
    public function edit($slug){
        $post = Post::where('slug',$slug)->first();
        return view('frontend.posts.edit',compact('post'));
    }
    public function update(EditPostRequest $request,$slug){
        $tags = explode(',',$request->tags);
        if($request->create_btn == 'save_btn'){
            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title).'sa'.mt_rand(100,999),
                'description' => $request->description,
                'content' => $request->content,
                'status' => 1,
            ];
            $post = Post::where('slug',$slug)->first();
            $post->update($data);
        }elseif($request->create_btn == 'post_btn'){
            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title).'sa'.mt_rand(100,999),
                'description' => $request->description,
                'content' => $request->content,
                'status' => 1,
                'type' => 1,
            ];
            $post = Post::where('slug',$slug)->first();
            $post->update($data);
            $user = User::findOrFail(Auth::user()->id);
            foreach ($user->followers as $follower) {
                $follower->notify(new PostNew($user, $post));
            }

        }

        foreach($tags as $item){
            $check = Tag::where('name',$item)->first();
            if($check == null){
                $tag = new Tag();
                $tag->name = $item;
                $tag->slug = Str::slug($item);
                $tag->status = 1;
                $tag->save();
                $post->tags()->sync($tag->id);
            }else{
                $post->tags()->sync($check->id);
            }
        }
        if($post->type == 1){
            return redirect()->route('posts.index');
        }else
            return redirect()->route('posts.draft');
    }
    public function destroy($slug){
        $post = Post::where('slug',$slug)->firstOrFail();
        $comments = Comment::where('post_id',$post->id)->get();
        foreach($comments as $comment){
            $comment->users()->detach();
            $comment->usersLiked()->detach();
            $comment->delete();
        }
        $post->tags()->detach();
        $post->users()->detach();
        $post->usersSavedPost()->detach();
        $post->delete();
        return back();
    }
}
