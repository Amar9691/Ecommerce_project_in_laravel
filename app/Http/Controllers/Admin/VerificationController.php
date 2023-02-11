<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = 'Admin/adminpanel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    




    public function verify(Request $request, $token)
    {

            $user = Admin::where('remember_token',$token)->update(['email_verified_at' => date('Y-m-d')]);

            if($user == true)
            {
               

                return redirect()->intended('Admin/adminpanel')->with('message','Account verified successfully');
            }
    }

    public function resend(Request $request)
    {
        
          $user = Admin::where('id',$request->id)->first();

          if($user->email_verified_at == Null)
          {
             $user->sendEmail();

             return redirect()->url('Admin/adminpanel')->with('resend','Fresh verification link sent to your registered Email address');

          }
           
    }


    

 
   

}
