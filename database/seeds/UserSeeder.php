<?php

use Illuminate\Database\Seeder;
use App\User;
USE \Illuminate\Support\Facades\DB;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $professionId =  App\Profession::where('title' , 'Desarrollador Back-end')->value('id');


//       dd($professionId);


        factory(User::class)->create([
        'name' => 'Juan Pablo',
        'email' => 'jpvillaplana@bamboo.cr',
        'password' => bcrypt('juanpi98'),
        'profession_id'=> $professionId,
           'is_admin' => true
    ]);

       factory(User::class)->create([
           'profession_id' => $professionId
       ]);



       factory(User::class, 48)->create();



//        DB::table('users')->insert([   SENTENCIA CON SQL
//            'name' => 'Juan Pablo',
//            'email' => 'jpvillaplana@bamboo.cr',
//            'password' => bcrypt('juanpi98'),
//            'profession_id'=> $professionid,
//        ]);
    }
}
