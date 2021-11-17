<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;
use App\Models\Category;
use App\Models\Tag;
use Carbon\carbon;
use Image;
use Auth;
use App\Notifications\NewAuthorPost;



class APostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('author.post.index',[
            'posts' => Auth::user()->posts()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('author.post.create',[
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
        $post->is_approve = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
         
         //Notification mail send

         $users = User::where('role_id',1)->get();
         Notification::send($users, new NewAuthorPost($post));

        Toastr::success('Post Successfully Saved :)','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        if ($post->user_id != Auth::id()) {
              Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }

         return view('author.post.show',compact('post'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }

           $categories = Category::all();
           $tags = Tag::all();
           return view('author.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
 {
    if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }


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
        $post->is_approve = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);


        Toastr::success('Post Successfully Updated :)','Success');
        return redirect()->route('author.post.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }

        
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
