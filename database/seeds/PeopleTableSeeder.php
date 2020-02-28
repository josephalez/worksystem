<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('people')->insert([
           'id' => '1',
           'firstname' => 'Eduardo',
           'lastname' => 'Lara',
           'email' => 'moncki21@gmail.com',
           'phone' => '02869615037',
           'trash' => 0,
           'isMember' => 1,
       ]);
       DB::table('people')->insert([
            'id' => '2',
            'firstname' => 'Andres',
            'lastname' => 'Rodrigues',
            'email' => 'andresrodrigues634@gmail.com',
            'phone' => '04147721568',
            'trash' => 0,
            'isMember' => 1,
      ]);
      DB::table('people')->insert([
           'id' => '3',
           'firstname' => 'Hector',
           'lastname' => 'Ferrer',
           'email' => 'hector1567xd@gmail.com',
           'phone' => '04126992473',
           'trash' => 0,
           'isMember' => 1,
       ]);
       DB::table('people')->insert([
            'id' => '4',
            'firstname' => 'Jose',
            'lastname' => 'Zurita',
            'email' => 'alejandrozurita13@gmail.com',
            'phone' => '04249239472',
            'trash' => 0,
            'isMember' => 1,
      ]);
        DB::table('people')->insert([
             'id' => '5',
             'firstname' => 'Gabriel',
             'lastname' => 'Marchandet',
             'email' => 'alejandrozurita13@gmail.com',
             'phone' => '04166880220',
             'trash' => 0,
             'isMember' => 1,
       ]);
       DB::table('people')->insert([
            'id' => '6',
            'firstname' => 'Luis',
            'lastname' => 'Bravo',
            'email' => 'luiscarlosbravo411@gmail.com',
            'phone' => '04168845046',
            'trash' => 0,
            'isMember' => 1,
        ]);
        DB::table('people')->insert([
             'id' => '7',
             'firstname' => 'Cristhian',
             'lastname' => 'Avila',
             'email' => 'cristhian.eduardo99@gmail.com',
             'phone' => null,
             'trash' => 0,
             'isMember' => 1,
         ]);
         DB::table('people')->insert([
              'id' => '8',
              'firstname' => 'Angel',
              'lastname' => 'Gonzalez',
              'email' => 'moncki21@gmail.com',
              'phone' => null,
              'trash' => 0,
              'isMember' => 1,
          ]);


    }
}
