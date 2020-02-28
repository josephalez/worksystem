<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
{
  public function create(Request $request){
      $_request = $request->all();
      $validator = Validator::make($request->all(), [
        'nombre' => ['required', 'string',],
        'color' => ['required', 'string',],
        'text' => ['required', 'string',],
        'icon' => ['required', 'string',],
      ]);
      if($validator->fails()){
          return response()->json($validator->errors(), 400);
      }
      $created = Estado::createEstado($request);
      if (!$created) return response()->json('Error de base de datos', 500);
      return response()->json('State Sucessfully Created', 200);
  }
  public static function edit(Request $request){
    $_request = $request->all();
    $state = DB::table('estados')
    ->where('id', $_request['id'])
    ->first();
    if(!$state) return response()->json('State not found', 404);
    $state = Estado::find($state->id);
    if(!$state) return response()->json('Database Error', 500);
    if (isset($_request['nombre'])) $state->nombre = $_request['nombre'];
    if (isset($_request['color'])) $state->color = $_request['color'];
    if (isset($_request['text'])) $state->text = $_request['text'];
    if (isset($_request['icon'])) $state->icon = $_request['icon'];
    if (isset($_request['type'])) $state->type = $_request['type'];
    $state->save();
    return response()->json('State Changed', 200);
  }
  public static function remove($id){
    $state = DB::table('estados')
    ->where('id', $id)
    ->first();
    if(!$state) return response()->json('State not found', 404);
    $state = Estado::find($state->id);
    if(!$state) return response()->json('Database Error', 500);
    $state->trash = 1;
    $state->save();
    return response()->json('State Removed', 200);
  }
  public function tomar(){
    $estados = Estado::getEstados();
    if (!$estados) return response()->json('Error de base de datos', 500);
    return response()->json($estados);
  }
  public function getByType($type){
    $estados = Estado::getByType($type);
    if (!$estados) return response()->json('Error de base de datos', 500);
    return response()->json($estados);
  }
}
