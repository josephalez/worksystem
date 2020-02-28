<?php

use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('offices')->insert([
           'id' => '1',
           'name' => 'Principal',
           'location' => 'C.C Alta Vista 1, Piso 2',
       ]);
    }
}
