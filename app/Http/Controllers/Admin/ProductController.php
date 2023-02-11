<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


use App\Models\Category;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function addProduct()
     {
       
        $procat = Category::all();

        return view('admin.home',['addProduct'=>'product','procate'=>$procat]);
     }

      public function tempcate()
     {
        $temprod = Product::onlyTrashed()->paginate(5);

        if($temprod->count() == 0)
        {
   
          return view('admin.home')->with('stat','Empty');

        }

         return view('admin.home',compact('temprod'));


     }
     
     public function restore($id)
     { 

            $restore =  Product::onlyTrashed()->where('id',$id)->first();
            
            $restore->restore();
            echo "<script>alert('restore successfully')</script>";

            return redirect()->route('products.index')->with('message','Restore successfully');

     }

     public function remove($id)
     { 

           
            $restore =  Product::onlyTrashed()->where('id',$id)->first();
            
            $restore->forceDelete();
            echo "<script>alert('Deleted paramently successfully')</script>";

            return redirect()->route('products.index')->with('message','successfully deleted');

     }









    public function index()
    {
         $product = Product::all();

      
         return view('admin.home',['pro'=>$product]);
         
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
         
       
           $path = 'image/android-chrome-192x192.png';


           if($request->hasFile('thumbnail'))
            {
                  
                   
               $extension = ".".$request->file('thumbnail')->extension();
               $name = basename($request->file('thumbnail')->getClientOriginalName(), $extension).time();
                $name = $name.$extension;
                $path = $request->thumbnail->storeAs('image', $name, 'public');

                
           $product = Product::create([
         
           'title'=>$request->title,
           'slug' => str_replace(' ','_', strToLower($request->title)),
           'description'=>$request->description,
           'thumbnail' => $path,
           'stock'=>$request->stock,
           'status' => $request->status,
           'options' => isset($request->extras) ? json_encode($request->extras) : null,
           'featured' => ($request->featured) ? $request->featured : 0,
           'price' => $request->price,
           'discount'=>$request->discount,
           'discount_price' => round(($request->price*(100 - $request->discount))/100,2),
            ]);


           if($product){
            
            $product->categories()->attach($request->category_id,['created_at'=>now(), 'updated_at'=>now()]);
            return redirect(route('products.index'))->with('message', 'Product Successfully Added');
            }
            else{
                }





            }
            else
            {

                return back()->with('message','Please Upload less 400kb size file');

            }
       
      
    }

    /**     (5000 * (100-30))/100
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
       

             $product =  Product::where('id',$id)->first();

             $procat = Category::all();

             return view('admin.home',['editproduct'=>$product,'prd'=>$procat]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request)
    {
       
       
      
            
            $request->validate([
               
               'title'=>'required',
               'description'=>'required|min:5',
               'stock'=>'nullable',
               'discount'=>'nullable',
               'thumbnail'=>'nullable',
               'status'=>'required',
               'price'=>'required',


            ]);


    

        if($request->has('thumbnail')){

            Storage::delete($product->thumbnail);

            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('image', $name, 'public');
            $product->thumbnail = $path;
         };


         
        $product->title =$request->title;
        $product->slug =  str_replace(' ', '-',$request->title);
        $product->description = $request->description;
        $product->status = $request->status;
        $product->featured = ($request->featured) ? $request->featured : 0;
        $product->price = $request->price;
        $product->discount = $request->discount ? $request->discount : 0;
        $product->discount_price = round(($request->price*(100 - $request->discount))/100,2);
        $product->categories()->detach();
        
        if($product->save()){
            $product->categories()->attach($request->category_id, ['created_at'=>now(), 'updated_at'=>now()]);
            return redirect(route('products.index'))->with('message', "Product Successfully Updated!");
        }else{
            return back()->with('message', "Error Updating Product");
        }


       
       
        









    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
           $product = Product::where('id',$id)->delete();
          
           

           return back()->with('message','deleted successfully');
    }
}