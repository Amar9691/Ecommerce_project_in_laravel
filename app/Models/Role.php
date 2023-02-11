<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
      protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        
    ];


 
}
