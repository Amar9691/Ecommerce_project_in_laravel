<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $order = Order::paginate(10);

        return view('admin.home',compact('order'));
            
    }

    public function trash()
    {
            $trashorder = Order::onlyTrashed()->paginate(5);

            return view('admin.home',compact('trashorder'));
    }
    public function porder($id)
    {
      
               $porder = Order::onlyTrashed()->where('id',$id)->forceDelete();

               if($porder)
               {
                 return back()->with('message','Order Remove successfully');
               }


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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $editorder = Order::find($id);

           return view('admin.home',compact('editorder'));
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
            $update = Order::where(['id'=>$id,'status'=>0])->update([
                  'OrderID'=>$request->orderid,
                  'user_id'=>$request->user_id,
                  'paymentstatus'=>$request->paymentstatus,
                  'price'=>$request->price,
                  'payment_id'=>$request->payment_id,
                  'delivery_at'=>$request->delivery_at,
                  'status'=>$request->status,
                  'product_id'=>implode(',',$request->product_id),
                  'qty'=>$request->qty,
                       
            ]);

            if($update)

            {
                return back()->with('message','order updated successfully');
            }
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
