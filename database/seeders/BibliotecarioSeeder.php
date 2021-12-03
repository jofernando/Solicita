<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BibliotecarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = DB::table('users')->where('name','bibliotecario')->pluck('id');
        DB::table('bibliotecarios')->insert([
          'matricula'=>'12345678900',
          'user_id'=> $user_id[0],
        ]);

        $user_id = DB::table('users')->where('name','bibliotecarioX')->pluck('id');
        DB::table('bibliotecarios')->insert([
          'matricula'=>'12345678912',
          'user_id'=> $user_id[0],
        ]);
    }
}
