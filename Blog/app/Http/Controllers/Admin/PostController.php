<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Notifications\AuthorPostAprovel;
use App\Notifications\SubcribeNewPost;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\carbon;
use App\Models\Subcribe;
use Image;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index',[
            'posts' => Post::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create',[
            'categories' => Category::all(),
             'tags' => Tag::all(),
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'image'       => 'required',
            'body'        => 'required',
            'categories'  => 'required',
            'tags'        => 'required',
        ]);

        $image = $request->file('image');
        $slug  = strtolower(str_replace(' ','-',$request->title));

        if (isset($image)) {
            //  make unique name for image

            $currentDate = Carbon::now()->toDateString();
            $imagename   =  $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            
             //    check category dir is exists

            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

             // resize image for category slider and upload
   
             Image::make($image)->resize(1600, 479)->save(storage_path('app/public/post').'/'.$imagename);      

        }else {
            $imagename = "default.png";
        }

        $post = new Post();

        $post->user_id   = Auth::id();
        $post->title     = $request->title;
        $post->slug      = $slug;
        $post->image     = $imagename;
        $post->body      = $request->body;

        if (isset($request->status)) {
             $post->status = true;
        }else{
              $post->status = false;
        }
        $post->is_approve = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subcribes = Subcribe::all();

        foreach($subcribes as $subcribe){
            Notification::route('mail',$subcribe->email)
            ->notify(New SubcribeNewPost($post));


        }


        Toastr::success('Post Successfully Saved :)','Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
           return view('admin.post.show',compact('post'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {  

           $categories = Category::all();
           $tags = Tag::all();
           return view('admin.post.edit',compact('post','categories','tags'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required',
            'image'       => 'image',
            'body'        => 'required',
            'categories'  => 'required',
            'tags'        => 'required',
        ]);

         $image = $request->file('image');
        $slug  = strtolower(str_replace(' ','-',$request->title));

        if (isset($image)) {
            //  make unique name for image

            $currentDate = Carbon::now()->toDateString();
            $imagename   =  $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            
             //    check post dir is exists

            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            // delete old image

              if (Storage::disk('public')->exists('post/'.$post->image)) {
                Storage::disk('public')->delete('post/'.$post->image);
            }

             // resize image for post slider and upload
   
             Image::make($image)->resize(1600, 479)->save(storage_path('app/public/post').'/'.$imagename);      

        }else {
            $imagename = $post->image;
        }


        $post->user_id   = Auth::id();
        $post->title     = $request->title;
        $post->slug      = $slug;
        $post->image     = $imagename;
        $post->body      = $request->body;

        if (isset($request->status)) {
             $post->status = true;
        }else{
              $post->status = false;
        }
        $post->is_approve = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);


        Toastr::success('Post Successfully Updated :)','Success');
        return redirect()->route('admin.post.index');


    }


    public function pending()
    {
        return view('admin.post.pending',[
            'posts' => Post::where('is_approve',false)->get()
        ]);
        
    }

    public function approve($id)
    {
        
        $post = Post::find($id);

        if ($post->is_approve == false) {
          $post->is_approve = true;
          $post->save();

            // notification send admin

        $post->user->notify(new AuthorPostAprovel($post));

         $subcribes = Subcribe::all();

        foreach($subcribes as $subcribe){
            Notification::route('mail',$subcribe->email)
            ->notify(New SubcribeNewPost($post));

        }

        Toastr::success('Post Successfully Approved :)','Success');
        return redirect()->route('admin.post.index');
        }else{
        Toastr::info('This Post is already approved','Info');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Storage::disk('public')->exists('post/'.$post->image)) {
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();

        $post->delete();
        Toastr::success('Post Successfully Updated :)','Success');
        return redirect()->back();
    }
}
