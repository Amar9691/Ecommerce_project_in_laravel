<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Auth;
use Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
        
         $this->middleware('auth');

     }



    public function index()
    {
      

        return view('home',['account'=>'user']);
         
    

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
         $profile = Profile::where(['user_id'=>$id,'role'=>'user'])->first();
         
         return view('home',['delete'=>$profile]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userprofile = Profile::where(['role'=>'user','user_id'=>$id])->first();

         $country  = Country::all();
         $state = State::all();
         $city = City::all();

        return view('home',compact('userprofile','country','state','city'));
    
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {

            $request->validate([

             'name'=>'required',
             'slug' => 'unique:profiles,slug',
             'thumbnail' => 'mimes:jpeg,bmp,png|max:1020',




             ]);


        
  
            if(Auth::user()->email !== $request->email)
            {

                $userupdate = User::where('id',Auth::user()->id)->update([

                  'email_verified_at'=> NULL, 
                  'name'=>$request->name,
                  'email'=>$request->email,

               ]);   

        
            }
    

            if($request->has('thumbnail')){

                $profile = new Profile;
                Storage::delete($profile->thumbnail);

               
                $extension = ".".$request->thumbnail->getClientOriginalExtension();
                $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
                $name = $name.$extension;
                $path = $request->thumbnail->storeAs('image', $name, 'public');
                
             

            }

            else
            {
                    $path = $request->path;
            }



         

           $update = Profile::where('role','user')->where('user_id',$request->id)->update   ([
                 
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

               return redirect()->route('home')->with('message','Your Profile Upate Successfully');

           }
 
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $data = array('email' => $request->email,'password'=>$request->password );
        
       $credentials =  Auth::guard()->attempt($data);

       if($credentials)
       {
           $user =  User::where(['id'=>$id,'email'=>$request->email])->delete();
        
           if($user)
           {
              Profile::where(['user_id'=>$id,'slug'=>$request->email])->delete();

              Auth::logout();

              return redirect()->route('main')->with('message','Your Account has been deleted successfully we will delete your completly within 7 Days all the best');
            }

       }
       else
       {
          return back()->with('message','Your Enter Password Was Incorrect');
       }

    

          

       
    }
}
