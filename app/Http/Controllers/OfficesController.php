<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OfficesController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
          'name' => ['required', 'string', 'min:4', 'max:32'],
          'location' => ['required', 'string', 'min:4', 'max:256'],
        ]);
        if($validator->fails()){
            return response()->json($validator, 400);
        }

        $created = Office::createOffice($request);
        if (!$created) return response()->json('Error de base de datos', 500);

        return response()->json('Office Creado Satisfactoriamente', 200);
    }

    public static function remove(Request $request){
      $_request = $request->all();
      $office = DB::table('offices')
      ->where('id',$_request['id'])
      ->first();
      if(!$office) return response()->json('Office no encontrado', 404);
      $office = Office::find($office->id);
      if(!$office) return response()->json('Error de base de datos', 500);
      $office->delete();
      return response()->json('Office Eliminado', 200);
    }

    public function get(){
      $offices = Office::getOffices();
      if (!$offices) return response()->json('Error de base de datos', 500);
      return response()->json($offices);
    }
}
