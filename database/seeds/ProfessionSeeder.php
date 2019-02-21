<?php

use Illuminate\Database\Seeder;

use App\Profession;

USE \Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('professions')->truncate();

//
//        DB::table('professions')->insert([
//            'title' => 'Desarrollador Front-end',
//        ]);
//
//
//        DB::table('professions')->insert([
//            'title' => 'Desarrollador Back-end',
//        ]);
//
//        DB::table('professions')->insert([
//            'title' => 'Diseñador Grafico',
//        ]);
//


        Profession::create([
            'title' => 'Desarrollador Front-end',
        ]);


        Profession::create([
            'title' => 'Desarrollador Back-end',
        ]);

        Profession::create([
            'title' => 'Diseñador Grafico',
        ]);


      factory(Profession::class, 48)->create();



    }
}
