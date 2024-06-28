<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\post;
use Illuminate\Support\Facades\Storage;
use Response;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $posts = $user->posts()->get(['id','name','imageurl','description','updated_at']);
        return view('userposts',['posts'=>$posts]);
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        $posts = $user->posts()->whereAny(['name','description','content'],'like','%'.$request->q.'%')->get();        
        return view('userposts',['posts'=>$posts]);
    }
    public function viewpost(Request $request)
    {
        $request->validate([
         'id'=>'required'
        ]);
        $id=$request->id;
        //$user = Auth::user();
        $selectedpost=post::find($id);
        return view('blog',['selectedpost'=>$selectedpost]);
    }
     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //name validation
        $request->validate([
            'name' => 'required|string|max:255',           
        ]);
        $post=new post;
        $user = Auth::user();
        $path="no-image.svg";
        if ($request->file('image')) {
            //if image exist validating image mime and size
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $path = time().'.'.$request->file('image')->extension();
            // Public Folder
            $request->file('image')->move(public_path('images'), $path);
         }     
         $post->imageurl="/images/".$path; 
        $post->userid=$user->getAuthIdentifier();
        $post->name=$request->input('name');
        $post->description=$request->input('description');
        if($post->save())
        return response()->json(['success' => true, 'message' => 'Post created successfully', 'path' => $path,'redirect'=>route("userposts")]);
        else 
        return response()->json(['success'=>false, 'message' => 'Post created Failed']);
      
    }
    public function savepost(Request $request)
    {
        $id=$request->input('id');
        if($id==null)
        return response()->json(['success'=>false, 'message' => 'Post id not null']);
      
        $post=post::find($id);        
        $post->content=$request->input('content');
        if($post->save())
        return response()->json(['success' => true, 'message' => 'Post added successfully','content'=>$post->content]);
        else 
        return response()->json(['success'=>false, 'message' => 'Post added Failed']);
      
    }
        /**
     * Update the specified resource in storage.
     */
    public function uploadimage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
        }
    public function update(Request $request)
    {
        $post=post::find($request->input("id"));
        $post->name=$request->input('name');
        $post->description=$request->input('description');       
        if($request->file('image'))
        {
        $oldfile=$post->imageurl;
        unlink(public_path($oldfile));
        $path = time().'.'.$request->file('image')->extension();

            // Public Folder
        $request->file('image')->move(public_path('images'), $path);
        $post->imageurl="/images/".$path;
        }
        if($post->save())
        return response()->json(['success' => true, 'message' => 'Updated', 'redirect'=>route("userposts")]);
        else 
        return response()->json(['success'=>false, 'message' => 'Update Failed']);
       }

    /**
     * Remove the specified resource from storage.
     */
    public function deletepost(Request $request)
    {
        $post=post::find($request->id);        
        if($post->delete())
        return response()->json(['success' => true, 'message' => 'Deleted', 'redirect'=>route("userposts")]);
        else
        return response()->json(['success'=>false, 'message' => 'Delete Failed']);
    }
}
