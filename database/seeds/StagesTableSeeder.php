<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//Muy inteligente el dejarme esto a mi... muy inteligente...

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('stages')->insert([
          'id' => 1,
          'name' => 'Contacto inicial',
          'percentage' => 1,
          'phase' => 1,
          'sback' => null,
          'snext' => 2,
      ]);
      DB::table('stages')->insert([
          'id' => 2,
          'name' => 'Mediacion temprana',
          'percentage' => 2,
          'phase' => 1,
          'sback' => 1,
          'snext' => 6,//oh no! this are a problem! (3 or 4 are the next... (next of 4 = 5))
          'bidirectional' => true, //gg
      ]);

      //Ruta "Proyecto"
      DB::table('stages')->insert([
          'id' => 3,
          'name' => 'Lista de caracteristicas',
          'percentage' => 1,
          'phase' => 1,
          'sback' => 2,
          'snext' => 6,//okok
      ]);

      //Ruta "Consultoria"
      DB::table('stages')->insert([
          'id' => 4,
          'name' => 'Estudio de caso',
          'percentage' => 1,
          'phase' => 1,
          'sback' => 2,
          'snext' => 5,//-->
      ]);

      DB::table('stages')->insert([
          'id' => 5,
          'name' => 'Propuesta',
          'percentage' => 1,
          'phase' => 1,
          'sback' => 4,
          'snext' => 6,
      ]);

      //Aqui se unifican ambas rutas nuevamente.
      DB::table('stages')->insert([
          'id' => 6,
          'name' => 'Wireframe / UI (Demo)',
          'percentage' => 1,
          'phase' => 1,
          'sback' => 2,
          'snext' => 7,
          'optional' => true
      ]);

      //FASE 2 - Analiis y Cotizacion
      DB::table('stages')->insert([
          'id' => 7,
          'name' => 'Analisis',
          'percentage' => 1,
          'percentage_max' => 2,
          'phase' => 2,
          'sback' => 6,
          'snext' => 8,
          'optional' => true
      ]);

      DB::table('stages')->insert([
          'id' => 8,
          'name' => 'Cotizacion',
          'percentage' => 1,
          'phase' => 2,
          'sback' => 7,
          'snext' => 11,
          'bidirectional' => true, //gg
      ]);

      //FASE 3 - Desarrollo

      DB::table('stages')->insert([
          'id' => 9,
          'name' => 'Mediacion',
          'percentage' => 2,
          'phase' => 3,
          'sback' => 8,
          'snext' => 11,
          'sparalel' => 10,
      ]);

      DB::table('stages')->insert([
          'id' => 10,
          'name' => 'Coordinacion',
          'percentage' => 2,
          'phase' => 3,
          'sback' => 8,
          'snext' => 11,
          'sparalel' => 9,
      ]);

      DB::table('stages')->insert([
          'id' => 11,
          'name' => 'Desarrollo',
          'percentage' => 0, //Si no lo terminan en tiempo optimo...
          'percentage_max' => 5,
          'phase' => 3,
          'sback' => 8,
          'snext' => 12,
      ]);

      DB::table('stages')->insert([
          'id' => 12,
          'name' => 'Seguro de calidad',
          'percentage' => 1,
          'phase' => 3,
          'sback' => 11,
          'snext' => 13,
      ]);

      DB::table('stages')->insert([
          'id' => 13,
          'name' => 'Deploy e instalacion',
          'percentage' => 0, //nada mano, eso es gratis
          'phase' => 3,
          'sback' => 12,
          'snext' => 14,
      ]);

      //FASE 4 - UDC
      DB::table('stages')->insert([
          'id' => 14,
          'name' => 'UDC',
          'percentage' => 0, //nada mano, eso es gratis x2 (de momento)
          'phase' => 4,
          'sback' => 13,
          'snext' => 15,
          'optional' => true
      ]);

      //FASE 5 - GARANTIA (?)
      DB::table('stages')->insert([
          'id' => 15,
          'name' => 'Garantia',
          'percentage' => 0, //nada mano, eso es gratis x2 (de momento)
          'phase' => 5,
          'sback' => 14,
          'snext' => null,
          'optional' => true
      ]);

    }
}
