<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Assistance extends Model
{
  use Notifiable;
  protected $fillable = [
      'id',
      'office',
      'member',
      'date',
      'entry',
      'leave',
  ];

  public static function createAssistance(Request $request){
    $_request = $request->all();
    return Assistance::create([
        'office' => $_request['office'],
        'member' => $_request['member'],
        'date' => $_request['date'],
        'entry' => $_request['entry'],
        'leave' => null,
    ]);
  }

  /*public static function get(Request $request, $date){
    $assistance = DB::table('assistances');
    ->where('date',$date);
    if (!$assistance) return response()->json('No assistances founded on this date', 404);
    return $assistance->get();
  }*/

  public static function getByOffice(Request $request){
    $_request = $request->all();
    $query = DB::table('assistances')
    ->where('office',$_request['office']);
    if(!$query) return response()->json('Assistance no encontrado', 404);
    return $query->get();
  }

  public static function getByMember(Request $request){
    $_request = $request->all();
    $query = DB::table('assistances')
    ->where('member',$_request['member']);
    if(!$query) return response()->json('Assistance no encontrado', 404);
    return $query->get();
  }

}
