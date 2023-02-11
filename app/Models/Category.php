<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','slug'];
    protected $dates = ['deleted_at'];

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public function childrens()
    {
        return $this->belongsToMany(Category::class,'category_parent','category_id','parent_id');
    }
}
