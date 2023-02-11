<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Admin;


class Profile extends Model
{

       use HasFactory;
       use SoftDeletes;
       protected $guarded =[];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','name','slug','role','address','phone','country_id','state_id','city_id'];
    
    protected $dates = ['deleted_at'];


    public function users()
    {
       return $this->belongsToMany(User::class);
    }

    public function admins()
    {
       return $this->belongsToMany(Admin::class);
    }
}
