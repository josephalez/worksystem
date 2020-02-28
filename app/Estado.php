<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;


class Estado extends Model
{
    use Notifiable;
    protected $fillable = [
        'id',
        'nombre',
        'color',
        'text',
        'icon',
        'trash',
        'type',
    ];
    public static function createEstado(Request $request){
      $_request = $request->all();
      return Estado::create([
          'nombre' => $_request['nombre'],
          'color' => $_request['color'],
          'text' => $_request['text'],
          'icon' => $_request['icon'],
          'type' => $_request['type'],
      ]);
    }
    public static function getEstados(){
      $query = DB::table('estados')->where('trash', 0);
      return $query->get();
    }
    public static function getByType($type){
      $query = DB::table('estados')->where('trash', 0)->where('type', $type);
      return $query->get();
    }
}
