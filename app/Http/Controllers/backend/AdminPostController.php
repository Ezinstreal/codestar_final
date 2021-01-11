<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddPostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminPostController extends Controller
{
    public function index(){
        $data = Post::all();
        return view('backend.posts.index',compact('data'));
    }
    public function create(){
        $tags = Tag::all();
        $author = User::all();
        return view('backend.posts.create',compact('tags','author'));
    }
    public function store(AdminAddPostRequest $request){
        $tags = explode(',',$request->tags);
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title).'sa'.mt_rand(100,999);
        $post->description = $request->description;
        $post->content = $request->content;
        $post->status = $request->status;
        $post->status2 = $request->status2;
        $post->type = $request->type;
        $post->save();
        $user = User::findOrFail($request->user);
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
        return redirect()->route('admin.posts.index')->with('success','Tao Moi Bai Viet Thanh Cong!');
    }
    public function edit($id){
        $author = User::all();
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        return view('backend.posts.edit',compact('post','author','tags'));
    }
    public function update(Request $request, $id){
        $tags = explode(',',$request->tags);
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title).'sa'.mt_rand(100,999),
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->status,
            'status2' => $request->status2,
            'type' => $request->type,
        ];
        $post = Post::findOrFail($id);
        $post->update($data);
        $post->users()->sync($request->user);

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
        return redirect()->route('admin.posts.index')->with('success','Update Thanh Cong!');
    }
    public function status(Request $request, $id){
        $post = Post::findOrFail($id);
        if($request->status == 1){
            $post->update(['status'=>0]);
        }else{
            $post->update(['status'=>1]);
        }
        return redirect()->route('admin.posts.index')->with('success','Sửa trạng thái thành công');;
    }
    public function status2(Request $request, $id){
        $post = Post::findOrFail($id);
        if($request->status2 == 1){
            $post->update(['status2'=>0]);
        }else{
            $post->update(['status2'=>1]);
        }
        return redirect()->route('admin.posts.index')->with('success','Sửa trạng thái thành công');;
    }
}
