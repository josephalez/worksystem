<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\MemberTask;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
  public function create(Request $request)
  {
    $_request = $request->all();

    $validator = Validator::make($_request, [
      'title' => ['required', 'string', 'min:2', 'max:32'],
      'description' => ['string', 'min:12', 'max:512'],
    ]);
    if($validator->fails())  return response()->json($validator->errors(), 400);

    $created = Task::createTask($request);
    if (!$created) return response()->json('Database Error', 500);
    $task_id = $created->id;

    if(isset($_request['owner']) && ($_request['owner'] != $_request['supervisor']) ){
      $member_id = $_request['owner'];
      $task_created = MemberTask::addTask($member_id,$task_id);
      if(!$task_created) return response()->json('Database Error', 500);
    }
    if(isset($_request['supervisor'])){
      $member_id = $_request['supervisor'];
      $task_created = MemberTask::addTask($member_id,$task_id);
      if(!$task_created) return response()->json('Database Error', 500);
    }

    return response()->json('Task Succesfully Created', 200);
  }

  public static function edit(Request $request){
    $_request = $request->all();
    $task = DB::table('tasks')
    ->where('id', $_request['id'])
    ->first();
    if(!$task) return response()->json('Task not found', 404);
    $task = Task::find($task->id);
    if(!$task) return response()->json('Database Error', 500);
    if (isset($_request['title'])) $task->title = $_request['title'];
    if (isset($_request['description'])) $task->description = $_request['description'];
    if (isset($_request['expiration'])) $task->expiration = $_request['expiration'];
    if (isset($_request['supervisor'])) $task->supervisor = $_request['supervisor'];
    if (isset($_request['owner'])) $task->owner = $_request['owner'];
    $task->save();
    return response()->json('Task Changed', 200);
  }

  public static function state(Request $request)
  {
      $_request = $request->all();
      $task = DB::table('tasks')
      ->where('id',$_request['id'])
      ->first();
      $state = DB::table('estados')
      ->where('id',$_request['state'])
      ->first();
      if(!$task) return response()->json('Task not found', 404);
      $task = Task::find($task->id);
      if(!$task) return response()->json('Database Error', 500);
      $task->state = $state->id;
      $task->save();
      return response()->json('State Changed', 200);
  }

  public static function remove(Request $request, $id){
    $task = DB::table('tasks')
    ->where('id', $id)
    ->first();
    if(!$task) return response()->json('Task not found', 404);
    $task = Task::find($task->id);
    if(!$task) return response()->json('Database Error', 500);
    $task->trash = 1;
    $task->save();
    return response()->json('Task Removed', 200);
  }

  public function all(){
    $tasks = Task::getAll();
    if (!$tasks) return response()->json('Database Error', 500);
    return response()->json($tasks);
  }

  public function getByProject($project){
    $tasks = Task::getByProject($project);
    if (!$tasks) return response()->json('Database Error', 500);
    return response()->json($tasks);
  }
}
