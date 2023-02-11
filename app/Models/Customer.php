<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['orderID','billing_firstName','email','billing_address1','billing_address2','billing_country','billing_state','billing_city','billing_zip','shipping_firstName','shipping_address1','shipping_address2','shipping_country','shipping_state','shipping_city','shipping_zip'];
    protected $guarded = [];

}
