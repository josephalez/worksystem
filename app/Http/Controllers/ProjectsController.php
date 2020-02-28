<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\MemberProject;
use App\OrganizationProject;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function create(Request $request)
    {
      $_request = $request->all();

      $validator = Validator::make($_request, [
        'title' => ['required', 'string', 'min:2', 'max:32'],
        'short_desc' => ['max:92'],
        'long_desc' => ['max:256'],
      ]);
      if($validator->fails())  return response()->json($validator->errors(), 400);

      $created = Project::createProject($request);
      if (!$created) return response()->json('Database Error', 500);
      if(isset($_request['organization'])){
        $project_id = $created->id;
        $project_created = OrganizationProject::addOrganization($request,$project_id);
        if(!$project_created) return response()->json('Database Error', 500);
      }
      return response()->json('Project Succesfully Created', 200);
    }

    public static function state(Request $request){
        $_request = $request->all();
        $project = DB::table('projects')
        ->where('id',$_request['id'])
        ->first();
        if(!$project) return response()->json('Project not found', 404);
        $state = DB::table('estados')
        ->where('id',$_request['state'])
        ->first();
        if(!$state) return response()->json('State not found', 404);
        $project = Project::find($project->id);
        if(!$project) return response()->json('Database Error', 500);
        $project->state = $state->id;
        $project->save();
        return response()->json('State Changed', 200);
    }

    public static function edit(Request $request){
      $_request = $request->all();
      $project = DB::table('projects')
      ->where('id', $_request['id'])
      ->first();
      if(!$project) return response()->json('Project not found', 404);
      $project = Project::find($project->id);
      if(!$project) return response()->json('Database Error', 500);
      if (isset($_request['title'])) $project->title = $_request['title'];
      if (isset($_request['short_desc'])) $project->short_desc = $_request['short_desc'];
      if (isset($_request['long_desc'])) $project->long_desc = $_request['long_desc'];
      if (isset($_request['leader'])) $project->leader = $_request['leader'];
      if (isset($_request['organization'])) $project->organization = $_request['organization'];
      $project->save();
      return response()->json('Project Changed', 200);
    }

    public static function remove(Request $request, $id){
      $project = DB::table('projects')
      ->where('id', $id)
      ->first();
      if(!$project) return response()->json('Project Not Found', 404);
      $project = Project::find($project->id);
      if(!$project) return response()->json('Database Error', 500);
      $project->trash = 1;
      $project->save();
      return response()->json('Project Removed', 200);
    }

    public static function addMember(Request $request){
      $_request = $request->all();
      $alreadyExist = DB::table('member_project')
      ->where('member_id',$_request['member_id'])
      ->where('member_id',$_request['member_id'])
      ->first();
      if ($alreadyExist) return response()->json('Member already added',400);
      $created = MemberProject::addMember($request);
      if (!$created) return response()->json('Database Error',500);
      return response()->json('Member Added Succesfully',200);
    }

    public function all(){
      $projects = Project::getAll();
      if (!$projects) return response()->json('Database Error', 500);
      return response()->json($projects);
    }
    public function members($id){
      $project = Project::find($id);
      if (!$project) return response('Project Not Found',401);
      return $project->members;
    }
}
