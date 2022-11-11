<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   function index(Request $request)
    {  
           
        $category = Category::all();

        if ($request->ajax()) {
                $categories =Category::all();
                return Datatables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function($categories){
                    $actionBtn = '<button type="button" name="edit" id="'.$categories->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                        $actionBtn = $actionBtn. '<button type="button" name="edit" id="'.$categories->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                        return $actionBtn;
                 
                })
                ->addColumn('image', function ($categories) { 
                    return '<img src="'.url('storage/'.$categories->image).'" width="65px" class="img-circle" />';
               })
                ->rawColumns(['action','image'])
                ->make(true);
            }
            
            return view('categories.index');
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            'name'=>$request->input('name')
        ]);
        return response()->json(['success'=>'Category Added successfully ']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Category::where('id',$id)->firstOrFail();
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'name'=>$request->input('editname')
        ]);
        return response()->json(['success'=>'Category updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrfail($id);
        $category->delete();
        return response()->json(['success'=>'Data is successfully updated']);
      
    }
}
