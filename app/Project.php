<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{

    use Notifiable;
    protected $fillable = [
            "title",
            'short_desc',
            'long_desc',
            'state',
            'leader',
            'trash',
    ];


    public static function createProject(Request $request){
        $_request = $request->all();
        return Project::create([
            'title' => $_request['title'],
            'short_desc' => $_request['short_desc'],
            'long_desc' => (isset($_request['long_desc'])) ? $_request['long_desc'] : null,
            'leader' => $_request['leader'],
            'organization' => (isset($_request['organization'])) ? $_request['organization'] : null,
        ]);
    }

    public static function getAll(){
      $projects = DB::table('projects')->where('trash', 0);
      return $projects->get();
    }

    public function members(){
        return $this->belongsToMany('App\Member');
    }
    public function organizations()
    {
        return $this->belongsToMany('App\Organization');
    }

}
