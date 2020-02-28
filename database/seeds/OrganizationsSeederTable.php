<?php

use Illuminate\Database\Seeder;

class OrganizationsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('organizations')->insert([
           'id' => '1',
           'title' => 'Consulting ME',
           'short_desc' => 'Nuestra Empresa Matriz',
           'long_desc' => 'Viva Chavez Viva Chavez Viva Chavez Viva Chavez Viva Chavez Viva Chavez ',
           'email' => 'moncki21@gmail.com',
           'phone' => '04147721568',
           'photo' => 'uploads/organizations\CM.png',
           'web' => 'globalhost.pw',
           'estado' => 3,
           'trash' => 0,
       ]);
    }
}
