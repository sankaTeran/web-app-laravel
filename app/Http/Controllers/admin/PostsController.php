<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
    $posts = Posts::with(['comments.user'])->get(); // eager load comments + commenter
    return view('admin.posts', compact('posts'));
}


    public function storePost(Request $request){

        $request->validate([
            'post_title' => 'required',
            'post_slug' => 'required',
            'post_body' => 'required',
            'post_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('post_image')){
            $imagePath = $request->file('post_image')->store('posts','public');
        }

        Posts::create([
            'title' => $request->post_title,
            'slug' => $request->post_slug,
            'body' => $request->post_body,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success','Post added successfully! ');
    }

    public function updatePost(Request $request){   
        $request->validate([
            'post_title' => 'required',
            'post_slug' => 'required',
            'post_body' => 'required',
        ]);

        if($request->hasFile('post_image')){
            $imagePath = $request->file('post_image')->store('posts','public');
        }   

        $post = Posts::find($request->post_id);
        $post->title = $request->post_title;
        $post->slug = $request->post_slug;
        $post->body = $request->post_body;
        if($request->hasFile('post_image')){
            $post->image = $imagePath;
        }
        $post->save();
        return redirect()->back()->with('success','Post updated successfully! ');
        
    }

    public function deletePost($id){
        $post = Posts::find($id);
        $post->delete();
        return redirect()->back()->with('success','Post deleted successfully! ');
    }

    public function indexComment(Request $request, $id)
{
    // Validate guest comment input
    $validated = $request->validate([
        'comment' => 'required|string|max:1000',
        'blog_id' => 'required|integer|exists:posts,id',
    ]);

    $save = new Comment;
    $save->user_id = Auth::check() ? Auth::user()->id : null;
    $save->blog_id = $request->blog_id;
    $save->comment = $request->comment;
    $save -> save();

    // dd([
    //     'route_id' => $id,
    //     'form_data' => $request->all()
    // ]);

    return redirect()->back()->with('success', 'Comment submitted successfully!');
}

    

}