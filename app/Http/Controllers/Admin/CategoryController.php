<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
     public function add()
     {
         $cata  = Category::all();

        return view('admin.home',['addcategory'=>'category','oldcate'=>$cata]);
     }
   
     public function tempcate()
     {
        $tempcate = Category::onlyTrashed()->paginate(5);

         return view('admin.home',compact('tempcate'));


     }
     
     public function restore($id)
     { 

            $restore =  Category::onlyTrashed()->where('id',$id)->first();
            
            $restore->restore();
            echo "<script>alert('restore successfully')</script>";

            return redirect()->route('categories.index');

     }

     public function remove($id)
     { 

           
            $restore =  Category::onlyTrashed()->where('id',$id)->first();
            
            $restore->forceDelete();
            echo "<script>alert('Deleted paramently successfully')</script>";

            return redirect()->route('catagories.index')->with('message','successfully deleted');

     }
     public function index()
     {
        $categories = Category::paginate(5);

     
         return view('admin.home',['cate'=>$categories]);

        

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title'=>'required|min:5',
            'slug'=>'required|unique:categories',
            'description'=>'required',

       ]);

  


       $category = Category::create([
              'title'=>$request->title,
              'description'=>$request->description,
              'slug'=> str_replace(' ','-', strToLower($request->title)),
            

        ]);
        $category->childrens()->attach($request->parent_id);

        return back()->with('message','category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $category = Category::where('id',$id)->first();
           $cata  = Category::where('id','!=',$id)->get();

           return view('admin.home',['cat'=>$category],compact('cata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request )
    {
             
           
              

            

            $update = Category::where('id',$id)->update([
                          
                          'title'=>$request->title,
                          'description'=>$request->description,
                          'slug'=>str_replace(' ', '-', strToLower($request->title))

             ]);

             if($update)
             {
                if($request->parent_id !== null)
                { 
                    $category = Category::where('id',$id)->first();
                    $category->childrens()->detach();
                   // foreach ($category as $value) {
                     //  $value->childrens()->detach();
                   // }
                    $category->childrens()->attach($request->parent_id);
                }
                else
                {
                    
                     $category = Category::where('id',$id)->first();
                     $category->childrens()->detach();

                  

                }
                return back()->with('message','update successfully');
             }

             //$category->title = $request->title;
            // $category->description = $request->description;
             //$category->slug = str_replace(' ', '-',$request->title);
             
             //$cat  = Category::where('id',$id)->get();
             //foreach($cat as $cate)
             //{
               // $cate->childrens()->detach();
             //}
             
             //$category->save();
             //return back()->with('message','update successfully');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $category = new Category;
        $category->destroy($id);
        $category->childrens()->detach();
        return back()->with('message','deleted successfully');
    }
}