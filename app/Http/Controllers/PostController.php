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
    public function index(Request $request)
    {  
           
        $category = Category::all();

        if ($request->ajax()) {
                $posts =Post::where('user_id',auth()->user()->id)->with('category')->get();
                return Datatables::of($posts)
                ->addIndexColumn()
                ->addColumn('action', function($posts){
                    $actionBtn = '<button type="button" name="edit" id="'.$posts->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                        $actionBtn = $actionBtn. '<button type="button" name="edit" id="'.$posts->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                        return $actionBtn;
                 
                })
                ->addColumn('image', function ($posts) { 
                    return '<img src="'.url('storage/'.$posts->image).'" width="65px" class="img-circle" />';
               })
                ->rawColumns(['action','image'])
                ->make(true);
            }
            
            return view('posts.index',compact('category'));
        

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
            'category_id'=>$request->category_id,
            'image'=>$imageName,
            'user_id' => Auth::id(),


        ]);
        return response()->json(['success'=>'Data is successfully Added']);
        // return redirect()->route('posts.index');
    }

    public function edit($id)
    {  
        
        if(request()->ajax())
        {
            $data = Post::where('id',$id)->with('category','user')->firstOrFail();
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request , $id)
    {  
            
        $post = Post::where('id',$id)->with('category','user');
        $imageName="";
        if(request()->ajax()){
          if(request()->hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $input['image'] = $imageName;
            request()->image->move(public_path('storage/'), $imageName);
            $post->update([
                'title' => $request->input('title'),
                'post_text' => $request->input('post_text'),
                'image'=>$imageName,
                "category_id"=>$request->Add_Category,
                'user_id' => Auth::id(),
            
                  ]);
          }
            else{
            }
            $post->update([
            'title' => $request->input('title'),
            'post_text' => $request->input('post_text'),
            "category_id"=>$request->Add_Category,
            'user_id' => Auth::id(),
        
              ]);
        
         return response()->json(['success'=>'Data is successfully updated']);
        }
}
    

    public function destroy($id)
    {
        
             $posts = Post::findorfail($id);
              $posts->delete();
             return response()->json(['success'=>'Data is successfully updated']);
        
    }


    public function dashboard(Request $request){

        
        $category = Category::all();
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
           
        return view('dashboard',compact('category'));
    }

  
}