<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Card;
use Session;
use App\Models\User;
use Auth;
use Str;
use App\Models\Order;

class AllController extends Controller
{

  
    
   

     public function checkout()
     {
      
        $user = User::where('id',Auth::user()->id)->first();

        if (!Session::has('card') || empty(Session::get('card')->getContents())) {
       
        return redirect()->route('yourcard')->with('message', 'No Products in the Cart');
      
        }
        else
        {
          
            $cart = Session::get('card');
       

            return view('main.checkout',['intent'=>$user->createSetupIntent()],compact('cart'));

        }

    
       


      }

    
    public function payment(Request $request)
    {





             
     
      
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = \Stripe\Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => [
            'line1' => $request->ad1,
            'line2' => $request->ad2,
            'postal_code' => $request->pin,
            'city' => $request->ad5,
            'state' =>$request->ad6,
            'country' => $request->ad7,
            ],  ]);

            \Stripe\Customer::createSource(
            $customer->id,
            ['source' => $request->stripeToken]
            );

   
            $result =   \Stripe\Charge::create ([
              "customer" => $customer->id,
              "amount" => $request->price*100,
              "currency" => "inr",
              "description" => "Test payment from stripe.test." , 
             ]);

   
      
            if($result)
            {
 
               $order = Order::create([
                    'OrderID'=>'ord#'.str::random(20),
                    'user_id'=>Auth::user()->id,
                    'product_id'=>implode(',',$request->product_id),
                    'paymentstatus'=>'done',
                    'qty'=>$request->qty,
                    'status'=>0,
                    'price'=>$request->price,
                    'payment_id'=>$result->balance_transaction,
                    'delivery_at'=> date_add(date_create(now()),date_interval_create_from_date_string("7 days")),

                                    ]);


               $customer = Customer::create([

                   'orderID'=>$order->OrderID,
                
                   'billing_firstName'=>$request->name,
                    
                   'email'=>$request->email,
                   'billing_address1'=>$request->ad1,
                   'billing_address2'=>$request->ad2,
                   'billing_country'=>$request->ad7,
                   'billing_state'=>$request->ad6,
                   'billing_city'=>$request->ad5,
                   'billing_zip'=>$request->pin,
                   'shipping_address1'=>$request->sh1,
                   'shipping_address2'=>$request->sh2,
                   'shipping_country'=>$request->sh7,
                   'shipping_state'=>$request->sh6,
                   'shipping_city'=>$request->sh5,
                   'shipping_firstName'=>$request->name,
                   'shipping_zip'=>$request->pin,
                   

                                            ]);

                            User::where('id',Auth::user()->id)->update([
                   
                            'stripe_id'=>$result->customer,
                   
                    
                                                                       ]);

        
               }


         $product = Product::find($request->product_id);
         
        
       
  
         return view('main.order',['pro'=>$product,'order'=>$order,'customer'=>$customer,'url'=>$result->receipt_url])->with('message','Your Order successfully Placed');







      


    }
  








    
    public function cate()
    {
        $cat = Category::all();
       	$products = Product::with('categories')->paginate(6);

        if(!Session::has('card'))
        {

           return view('welcome',compact('cat','products'));

        }
      else
      {
        $cart = Session::get('card');
        

    	  return view('welcome',compact('cat','products','cart'));
      }

    }

    public function single($id)
    {
        $product = Product::where('id',$id)->first();
          
        return view('main.signle',compact('product'));


    }

    public function addcart($id,Request $request)
    { 

                $product  =   Product::where('id',$id)->first();

                $oldcard  =  Session::has('card') ? Session::get('card'):null;

                $card  = new Card($oldcard);

                $qty = $request->qty ? $request->qty : 1;

                $card->addProduct($product,$qty);
                Session::put('card',$card);
                return redirect()->route('yourcard')->with('message','Item successfully add to Your Card');


    }

    public function card()
    {
      if(!Session::has('card'))
      {
        return view('main.card')->with('message','Your card is emptpy ');
      }
      else
      {
        $cart = Session::get('card');
        return view('main.card',compact('cart'));
      }
    }

    public function removecard($id)
    { 
         $product = Product::where('id',$id)->first();

        

          $oldcard = Session::has('card') ? Session::get('card'):null;

          $card = new Card($oldcard);

          $card->removeProduct($product);

          Session::put('card',$card);
          
          return back()->with('message','Product Has been remove successfully');



    }
    public function updatecart($id,Request $request)
    {
          $product = Product::where('id',$id)->first();

          $qty = $request->qty;

          $oldcard = Session::has('card') ? Session::get('card'):null;

          $card = new Card($oldcard);

          $card->updateProduct($product,$qty);

          Session::put('card',$card);
          
          return back()->with('message','Card Has been updated successfully');

    }

  
}
