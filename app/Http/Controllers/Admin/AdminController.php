<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Profile;
use App\Models\Customer;
use App\Models\returnrequest;
use Auth;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
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


    public function index()
    { 


        $admins = Profile::where('role','admin')->get();
    
        return view('admin.home',compact('admins'));
    }
    
    public function allreturn()
    {
              $return = returnrequest::paginate(4);

              return view('admin.home',compact('return'));

    }

    public function returnupdaterequest($id)
    {
          $returnupdate = returnrequest::find($id);

          return view('admin.home',compact('returnupdate'));


    }
    public function returnupdate($id,Request $request)
    {
         $update = returnrequest::where('id',$id)->update([

                 'id'=>$id,
                 'orderid'=>$request->orderid,
                 'user_id'=>$request->user_id,
                 'user_email'=>$request->user_email,
                 'issue'=>$request->issue,
                 'return_status'=>$request->return_status,
                 'created_at'=>$request->created_at,
                 'updated_at'=>date('Y-m-d'),


         ]);
         return back()->with('message','Update Successed');

    }

    public function temp()
    {
       $tempadmin =   Admin::onlyTrashed()->get();

       

       return view('admin.home',compact('tempadmin'));
     }


    public function Restore($id)
    {
        $restore = Admin::onlyTrashed()->where('id',$id)->restore();

        if($restore)
        {
            Profile::onlyTrashed()->where('user_id',$id)->where('role','admin')->restore();

             
        }

        return redirect()->route('adminpanel.index')->with('message','Admin Restore Successed');

    }

    public function remove($id)
    {
  
         $restore = Admin::onlyTrashed()->where('id',$id)->first();

         $restore->forceDelete();

 
         $profile =  Profile::onlyTrashed()->where('user_id',$id)->first();

         $profile->forceDelete();


 

        return redirect()->route('adminpanel.index')->with('message','Admin removed Successed');

         


    }









    public function adminpro()
    {
      
        $profile = Profile::where('user_id',Auth::user()->id)->first();

        $country = Country::all();

        $state = State::all();
      
        $city  = City::all();
    
        return view('admin.home',['profile'=>$profile,'country'=>$country,'state'=>$state,'city'=>$city]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         

         return view('admin.home',['createadmin'=>'createadmin']);
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
          
             $request->validate([

             'name'=>'required',
             'slug' => 'unique:profiles,slug',
             'thumbnail' => 'mimes:jpeg,bmp,png|max:1020',




             ]);


        
            if(Auth::user()->email !== $request->email)
            {

                $adminupdate = Admin::where('id',Auth::user()->id)->update([

                  'email_verified_at'=> NULL, 
                  'name'=>$request->name,
                  'email'=>$request->email,

              ]);   

        
            }
    

            if($request->has('thumbnail')){
               
                $extension = ".".$request->thumbnail->getClientOriginalExtension();
                $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
                $name = $name.$extension;
                $path = $request->thumbnail->storeAs('image', $name, 'public');
                
             
            }
            else
            {
                    $path = $request->path;
            }



         

          $update = Profile::where('role','admin')->where('user_id',$request->id)->update([
                 
                  'name'=>$request->name,
                  'slug'=>$request->email,
                  'address'=>$request->address,
                  'country_id'=>$request->country,
                  'state_id'=>$request->state,
                  'city_id'=>$request->city,
                  'phone'=>$request->mobile,
                   'thumbnail' => $path,
                   ]);


       if($update == true)
       {

           return redirect()->route('adminpanel.index')->with('message','Your Profile Upate Successfully');

       }
 


       




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $delete = Admin::where('id',$id)->delete();

        if($delete)
        {
           Profile::where('user_id',$id)->where('role','admin')->delete();
        }
                            
      return redirect()->route('adminpanel.index')->with('message','Admin block suspend if you want delete paramently then remove from trash');

    }


    public function billing()
    {
        $bill = Customer::paginate(5);
        return view('admin.home',compact('bill'));
    }
}
