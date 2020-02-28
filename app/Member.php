<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Project;


class Member extends Model
{
    use Notifiable;
    protected $fillable = [
        'id',
        'person',
        'role',
        'trash',
    ];

    public static function createMember(Request $request){
      $_request = $request->all();
      return Member::create([
          'person' => $_request['person'],
          'role' => $_request['role'],
      ]);
    }

    public function getPersonObjectAttribute(){
      $person = DB::table('people')->find($this->person);

      $response = ['firstname' => 'No existe.'];

      if ($person)
        $response = $person;

      return $response;
    }

    public static function getMembers(){
      $members = Member::get()->where('trash', 0);

      foreach ($members as $member)
        $member->person_object = $member->person_object;

      return $members;
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

}
