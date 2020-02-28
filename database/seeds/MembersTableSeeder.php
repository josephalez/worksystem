<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('members')->insert([
           'id' => '1',
           'person' => '1',
           'role' => 'Developer - Devops',
           'trash' => 0,
       ]);
       DB::table('members')->insert([
          'id' => '2',
          'person' => '2',
          'role' => 'Developer - Frontend',
          'trash' => 0,
      ]);
      DB::table('members')->insert([
           'id' => '3',
           'person' => '3',
           'role' => 'Dir. Proyectos',
           'trash' => 0,
      ]);
      DB::table('members')->insert([
        'id' => '4',
        'person' => '4',
        'role' => 'Developer - Fullstack',
        'trash' => 0,
      ]);
      DB::table('members')->insert([
        'id' => '5',
        'person' => '5',
        'role' => 'Dir. Comunicaciones',
        'trash' => 0,
      ]);
      DB::table('members')->insert([
        'id' => '6',
        'person' => '6',
        'role' => 'Frontend (P)',
        'trash' => 0,
      ]);
      DB::table('members')->insert([
        'id' => '7',
        'person' => '7',
        'role' => 'Tecnico en redes (P)',
        'trash' => 0,
      ]);
      DB::table('members')->insert([
        'id' => '8',
        'person' => '8',
        'role' => 'Dir. Tecnologias',
        'trash' => 0,
      ]);
    }
}
