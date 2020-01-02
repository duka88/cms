<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('users')->insert([  
            'name' => 'duka',         
            'email' => "test@mail.com",
            'password' => bcrypt('test@mail.com'),
            'role' => 'admin',          
            'created_at' => Carbon::now()
            
        ]);
    }
}
   