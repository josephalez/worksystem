<?php

use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('estados')->insert([
         'id' => 1,
         'nombre' => 'Pendiente',
         'color' => 'negative',
         'text' => 'white',
         'icon' => 'priority_high',
         'type' => 1
       ]);

       DB::table('estados')->insert([
         'id' => 2,
         'nombre' => 'En Progreso',
         'color' => 'yellow-6',
         'text' => 'black',
         'icon' => 'sync',
         'type' => 1
       ]);

       DB::table('estados')->insert([
         'id' => 3,
         'nombre' => 'Completado',
         'color' => 'green-14',
         'text' => 'white',
         'icon' => 'done',
         'type' => 1
       ]);

       DB::table('estados')->insert([
          'id' => 4,
          'nombre' => 'Abandonado',
          'color' => 'negative',
          'text' => 'white',
          'icon' => 'priority_high',
          'type' => 2
        ]);

        DB::table('estados')->insert([
          'id' => 5,
          'nombre' => 'En Progreso',
          'color' => 'yellow-6',
          'text' => 'black',
          'icon' => 'sync',
          'type' => 2
        ]);

        DB::table('estados')->insert([
          'id' => 6,
          'nombre' => 'Completado',
          'color' => 'green-14',
          'text' => 'white',
          'icon' => 'done',
          'type' => 2
        ]);

        DB::table('estados')->insert([
           'id' => 7,
           'nombre' => 'No Cumplida',
           'color' => 'negative',
           'text' => 'white',
           'icon' => 'priority_high',
           'type' => 3
         ]);

         DB::table('estados')->insert([
           'id' => 8,
           'nombre' => 'En Progreso',
           'color' => 'yellow-6',
           'text' => 'black',
           'icon' => 'sync',
           'type' => 3
         ]);

         DB::table('estados')->insert([
           'id' => 9,
           'nombre' => 'Cumplida',
           'color' => 'green-14',
           'text' => 'white',
           'icon' => 'done',
           'type' => 3
         ]);
    }
}
