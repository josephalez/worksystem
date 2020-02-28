<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use Notifiable;
    protected $fillable = [
            "title",
            'description',
            'expiration',
            'supervisor',
            'project',
            'owner',
            'state',
            'trash',
    ];

    public static function createTask(Request $request){

        $_request = $request->all();
        return Task::create([
            'title' => $_request['title'],
            'project' => $_request['project'],
            'description' => (isset($_request['description'])) ? $_request['description'] : null,
            'expiration' => (isset($_request['expiration'])) ? $_request['expiration'] : null,
            'supervisor' => (isset($_request['supervisor'])) ? $_request['supervisor'] : null,
            'owner' => (isset($_request['owner'])) ? $_request['owner'] : null,
        ]);

    }

    public static function getAll(){
      $tasks = DB::table('tasks')->where('trash', 0);
      return $tasks->get();
    }
    public static function getByProject($project){
      $tasks = DB::table('tasks')->where('trash', 0)->where('project', $project);
      return $tasks->get();
    }
}
