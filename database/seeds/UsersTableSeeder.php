<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
           'id' => '1',
           'username' => 'Moncki',
           'password' => Hash::make('27935371a'),
           'role' => '3',
           'member' => 1
       ]);
       DB::table('users')->insert([
            'id' => '2',
            'username' => 'Darens',
            'password' => Hash::make('1234'),
            'role' => '3',
            'member' => 2
      ]);
      //Coño vale
      DB::table('users')->insert([
           'id' => '3',
           'username' => 'HectorXD',
           'password' => Hash::make('martha2'),
           'role' => '3',
           'member' => 3
      ]);

      DB::table('users')->insert([
        'id' => '4',
        'username' => 'Allez',
        'password' => Hash::make('jtam23'),
        'role' => '3',
        'member' => 4
      ]);
      DB::table('users')->insert([
        'id' => '5',
        'username' => 'marshandet',
        'password' => Hash::make('22272443'),
        'role' => '3',
        'member' => 5
      ]);
      DB::table('users')->insert([
        'id' => '6',
        'username' => 'Lucho',
        'password' => Hash::make('9561112014'),
        'role' => '3',
        'member' => 6
      ]);
      DB::table('users')->insert([
        'id' => '7',
        'username' => 'ACCE',
        'password' => Hash::make('kasimiroturraja'),
        'role' => '3',
        'member' => 7
      ]);
      DB::table('users')->insert([
        'id' => '8',
        'username' => 'enshel',
        'password' => Hash::make('eduardoeslindo'),
        'role' => '3',
        'member' => 8
      ]);
   }
}
