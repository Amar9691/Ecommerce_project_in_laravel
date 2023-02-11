<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 $role = Role::create([
                'name'=>'customer',
                'description'=>'Customer role',
    	 ]);
         
         $role = Role::create([
                'name'=>'Admin',
                'description'=>'Admin role',
    	 ]);

    	 $user = User::create([
                
                'name'=>'Admin',
                'email'=>'admin12@gmail.com',
                'password'=> bcrypt('secret'),
                'role_id'=> $role->id,

    	 ]);

    	 Profile::create([
             'user_id'=>$user->id,


    	 ]);
    }
}
