<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;

use Illuminate\Http\Request;
use App\Models\returnrequest;
use Auth;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $order = Order::where('user_id',Auth::user()->id)->paginate(2);
        $product = Product::all();


        return view('home',compact('order','product'));


    }

    public function invoice($id)
    {
        $inorder = Order::find($id);

        $pro = Product::where('id',$inorder->product_id)->get();
        $customer = Customer::where('orderid',$inorder->OrderID)->first();
        return view('home',compact('inorder','pro','customer'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $return =  returnrequest::create([
               'orderid'=>$id,
               'issue'=>'i dont like this color',
               'user_id'=>Auth::user()->id,
               'user_email'=>Auth::user()->email,
               'return_status'=>'pending',
               'created_at'=>date('Y-m-d'),
               'updated_at'=>date('Y-m-d'),



         ]);

         Order::where('id',$id)->update([
                   
                   're'=>1,

               ]);
         

        if($return)
        {
            return back()->with('message','Request submitted successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


       /* $return =  returnrequest::create([
               'orderid'=>$id,
               'issue'=>'i dont like this color',
               'returnstatus'=>'pending',
               'created_at'=>date('Y-m-d'),
               'updated_at'=>date('Y-m-d'),



         ]);

        if($return)
        {
            return back()->with('message','Request submitted successfully');
        }*/


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $result = Order::destroy($id);

          if($result)
          {
            return back()->with('message','order cancel successfully');
          }
    }
}
