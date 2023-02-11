<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\adminemail;
use App\Notifications\AdminPasswordResetRequest;
use App\Notifications\passwordchange;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Profile;
use Auth;
class Admin extends Authenticatable implements MustVerifyEmail
{
    use  Notifiable;
     use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminPasswordResetRequest($token,$this));
    }

    public function passwordresetmessage()
    {
        $this->notify(new passwordchange($this));
    }
    public function sendEmail()
    {
    
       $this->notify(new adminemail($this));


    }

    public function profile()
    {

         return $this->hasOne(Profile::class);
    }
  
  
}
