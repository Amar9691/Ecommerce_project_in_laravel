<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnrequest extends Model
{
    use HasFactory;

    protected $fillable = ['orderid','issue','user_id','user_email','return_status','create_at','updated_at'];




}
