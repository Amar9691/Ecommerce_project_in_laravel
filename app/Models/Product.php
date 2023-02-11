<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;


class Product extends Model
{
    use HasFactory;
     use SoftDeletes;
     protected $guarded =[];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function categories()
    {
    	return $this->belongsToMany(Category::class,'category_product');
    }


   
}
