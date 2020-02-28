<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;

class MemberTask extends Model
{
  use Notifiable;
  protected $fillable = [
      'id',
      'member_id',
      'task_id',
      'trash',
  ];
  protected $table = 'member_task';
  public static function addTask($member_id, $task_id){
      $member = DB::table('members')->where('id',$member_id);
      if (!$member) return response()->json('Member not found',404);
      $task = DB::table('tasks')->where('id',$task_id);
      if (!$task) return response()->json('Task not found',404);
      return MemberTask::create([
          'member_id' => $member_id,
          'task_id' => $task_id,
      ]);
    }
}
