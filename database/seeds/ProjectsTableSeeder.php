<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('projects')->insert([
           'id' => '1',
           'title' => 'Worksystem',
           'short_desc' => 'Sistema de Trabajo de CM',
           'long_desc' => 'Turbotastico',
           'state' => 5,
           'leader' => 1,
           'trash' => 0,
       ]);
    }
}
