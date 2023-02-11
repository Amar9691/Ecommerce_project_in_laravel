<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Auth;

class ProfileController extends Controller
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
        
          
        $customer = Profile::where('role','user')->get();

        $country  = Country::all();
        $state = State::all();
        $city = City::all();

        return view('admin.home',compact('customer','country','state','city'));


    }
   
    public function trash()
    {
          
        $usertrash = User::onlyTrashed()->get();

      

        return view('admin.home',compact('usertrash'));



    }
   
    public function Restore($id)
    {
        $restore = User::onlyTrashed()->where('id',$id)->restore();

        if($restore)
        {
            Profile::onlyTrashed()->where('user_id',$id)->where('role','user')->restore();

             
        }

        return redirect()->route('profile.index')->with('message','User Restore Successed');

    }

    public function remove($id)
    {
  
         $restore = User::onlyTrashed()->where('id',$id)->first();

         $restore->forceDelete();

 
         $profile =  Profile::onlyTrashed()->where('user_id',$id)->where('role','user')->first();

         $profile->forceDelete();


 

        return redirect()->route('profile.index')->with('message','User removed Successed');

         


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $delete = User::where('id',$id)->delete();

        if($delete)
        {
           Profile::where('user_id',$id)->where('role','user')->delete();
        }
                            
        return redirect()->route('adminpanel.index')->with('message','User block suspend if you to mymistake then recover from restore or remove from trash');


    }
}
