<?php

namespace App\Http\Controllers;

use App\Assistance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AssistanceController extends Controller
{
    public function create(Request $request){
        $_request = $request->all();
        $_request['date'] = Carbon::parse($_request['date'])->format('Y-m-d');
        $_request['entry'] = Carbon::parse($_request['entry'])->format('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
          'office' => ['required', 'numeric','digits_between:1,20'],
          'member' => ['required', 'numeric','digits_between:1,20'],
          'date' => ['required', 'date'],
          'entry' => ['required',],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $assistance = DB::table('organizations')
        ->where('date', $_request['date'])
        ->where('member', $_request['member']);
        if (!$assistance){
          $created = Assistance::createAssistance($request);
          if (!$created) return response()->json('Error de base de datos', 500);
          return response()->json('Assistance Created Satisfactorily', 200);
        }else {
          return response()->json('You have already mark your entry today', 200);
        }

    }
    public static function leave(Request $request){
      $_request = $request->all();
      $_request['date'] = Carbon::parse($_request['date'])->format('Y-m-d');
      $_request['leave'] = Carbon::parse($_request['leave'])->format('Y-m-d H:i:s');
      $assistance = DB::table('assistances')
      ->where('office',$_request['office'])
      ->where('member',$_request['member'])
      ->where('date',$_request['date'])
      ->first();
      if(!$assistance) return response()->json('Assistance no encontrado', 404);
      $assistance = Assistance::find($assistance->id);
      if(!$assistance) return response()->json('Error de base de datos', 500);
      $assistance->leave = $_request['leave'];
      $assistance->save();
      return response()->json('See You Tomorrow!', 200);
    }

    public static function remove(Request $request, $id)
    {
      $assistance = DB::table('organizations')
      ->where('id', $id)
      ->first();
      if(!$assistance) return response()->json('Assistance no encontrada', 404);
      $assistance = Assistance::find($assistance->id);
      if(!$assistance) return response()->json('Error de base de datos', 500);
      $assistance->delete();
      return response()->json('Assistance Eliminada', 200);
    }

    public function get($date){
      $assistance = DB::table('assistances')
      ->where('date', $date);
      if (!$assistance) return response()->json('No assistances founded on this date', 404);
      return $assistance->get();
    }

    public function getByMember(){
      $assistances = Assistance::getByMember();
      if (!$assistances) return response()->json('Error de base de datos', 500);
      return response()->json($assistances);
    }
    public function getByOffice(){
      $assistances = Assistance::getByOffice();
      if (!$assistances) return response()->json('Error de base de datos', 500);
      return response()->json($assistances);
    }
    public function getByDate(){
      $assistances = Assistance::getByDate();
      if (!$assistances) return response()->json('Error de base de datos', 500);
      return response()->json($assistances);
    }
}
