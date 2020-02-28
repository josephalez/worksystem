<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
          'person' => ['required', 'numeric','digits_between:1,20'],
          'role' => ['required', 'string', 'min:4', 'max:32'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $created = Member::createMember($request);
        if (!$created) return response()->json('Database Error', 500);

        return response()->json('Member Succesfully Created', 200);
    }

    public static function remove(Request $request, $id){
      $member = DB::table('members')->where('id', $id)->first();
      if(!$member) return response()->json('Member not found', 404);
      $member = Member::find($member->id);
      if(!$member) return response()->json('Database Error', 500);
      $member->trash = 1;
      $member->save();
      return response()->json('Person Removed', 200);
    }

    public function get(){
      $members = Member::getMembers();
      if (!$members) return response()->json('Database Error', 500);
      return response()->json($members);
    }

    public function projects($id){
      $member = Member::find($id);
      if (!$member) return response('Member Not Found',401);
      return $member->projects;
    }

    public function tasks($id){
      $member = Member::find($id);
      if (!$member) return response('Member Not Found',401);
      return $member->tasks;
    }
}
