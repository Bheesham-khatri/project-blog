<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        
        // if(auth()->user()->is_admin==1){
        //     $posts = Post::with('category')->paginate(5);
        //     return view('posts.index', compact('posts'));
        // }else {
            
            $posts = Post::where('user_id',auth()->user()->id)->with('category')->paginate(5);
            return view('posts.index', compact('posts'));
        // }
    
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
      
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $input['image'] = $imageName;
        request()->image->move(public_path('storage'), $imageName);

        
        Post::create([
            'title' => $request->input('title'),
            'post_text' => $request->input('post_text'),
            'category_id' => $request->input('category_id'),
            'image'=>$imageName,
            'user_id' => Auth::id(),


        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
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

        return view('posts.edit', compact('post', 'categories'));
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
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $input['image'] = $imageName;
        request()->image->move(public_path('storage'), $imageName);
        $post->update([
            'title' => $request->input('title'),
            'post_text' => $request->input('post_text'),
            'category_id' => $request->input('category_id'),
            'image'=>$imageName,
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        
        $posts = Post::findorfail($id);
            $posts->delete();
             return response()->json(['success'=>'Data is successfully updated']);
        
    }


    public function dashboard(Request $request){
     
        if ($request->ajax()) {
            $posts = Post::with('category','user')->get();
            return Datatables::of($posts)
            ->addIndexColumn()
            ->addColumn('action', function($posts){
              if(auth()->user()->is_admin){
                 
                    $actionBtn = '<button type="button" name="edit" id="'.$posts->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $actionBtn = $actionBtn. '<button type="button" name="edit" id="'.$posts->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $actionBtn;
             }
            })
          
            
            ->addColumn('image', function ($posts) { 
                return '<img src="'.url('storage/'.$posts->image).'" width="65px" class="img-circle" />';
           })
            ->rawColumns(['action','image'])
            ->make(true);
        }
    
        return view('dashboard');
    }

  
}