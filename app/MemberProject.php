<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;

class MemberProject extends Model
{
    use Notifiable;
    protected $fillable = [
        'id',
        'member_id',
        'project_id',
        'trash',
    ];
    protected $table = 'member_project';
    public static function addMember(Request $request){
        $_request = $request->all();
        $member = DB::table('members')->where('id',$_request['member_id']);
        if (!$member) return response()->json('Member not found',404);
        $project = DB::table('projects')->where('id',$_request['project_id']);
        if (!$project) return response()->json('Project not found',404);
        return MemberProject::create([
            'member_id' => $_request['member_id'],
            'project_id' => $_request['project_id'],
        ]);
      }
}
