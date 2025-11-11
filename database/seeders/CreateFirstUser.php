<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $data['name']     = 'Admin';
        $data['email']    = 'wilhelm@pcr.ac.id';
        $data['password'] = Hash::make('wilhelmsamto');
        User::create($data);

        //User::create(;
         //['name']     = $request->name;
        //['email']    = $request->email;
        //['password'] = $request->password;
       //['password'] = Hash::make($request->password);
    }
}
