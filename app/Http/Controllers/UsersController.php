<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;


class UsersController extends Controller
{



  public static function edit(Request $request)
  {
    $_request = $request->all();
    $user = DB::table('users')
    ->where('id', $_request['id'])
    ->first();
    if(!$user) return response()->json('User not found', 404);
    $user = User::find($user->id);
    if(!$user) return response()->json('Database Error', 500);
    if (isset($_request['username'])) $user->username = $_request['username'];
    if (isset($_request['role'])) $user->role = $_request['role'];
    if (isset($_request['member'])) $user->member = $_request['member'];
    $user->save();
    return response()->json('User Changed', 200);
  }

  public function me(){
    return Auth::user();
  }

  public function all(){
    $users = User::getAll();
    if (!$users) return response()->json('Database Error', 500);
    return response()->json($users);
  }

  public static function remove(Request $request, $id)
  {
    $_request = $request->all();
    $user = DB::table('users')
    ->where('id', $id)
    ->first();
    if(!$user) return response()->json('User not found', 404);
    $user = User::find($user->id);
    if(!$user) return response()->json('Database Error', 500);
    $user->delete();
    return response()->json('User Removed', 200);
  }
}
