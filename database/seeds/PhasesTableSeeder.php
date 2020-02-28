<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PhasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Hector, ¿por que fuerzas un ID? si se genera automatico...
        //Por que vamos a trabajar con IDs exactos para las proximas seeders en cuanto a fases y etapas.

        DB::table('phases')->insert(['id' => 1,'name' => 'Negociacion']);
        DB::table('phases')->insert(['id' => 2,'name' => 'Analisis y cotizacion']);
        DB::table('phases')->insert(['id' => 3,'name' => 'Desarrollo']);
        DB::table('phases')->insert(['id' => 4,'name' => 'UDC']);
        DB::table('phases')->insert(['id' => 5,'name' => 'Garantia']);

    }
}
