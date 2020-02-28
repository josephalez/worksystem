<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Helpers\MPage;

class Person extends Model
{
  use Notifiable;
  protected $fillable = [
      'id',
      'firstname',
      'lastname',
      'language',
      'email',
      'source',
      'phone',
      'lead',
      'message',
      'trash',
      'isMember',
  ];

  public static function createPerson(Request $request){
    $_request = $request->all();
    if(!isset($_request['phone'])){
      $_request['phone'] = null;
    }
    return Person::create([
        'firstname' => $_request['firstname'],
        'lastname' => $_request['lastname'],
        'email' => $_request['email'],
        'phone' => $_request['phone'],
        'isMember' => $_request['isMember'],
    ]);
  }

  public static function getPeople(){
    $query = DB::table('people')->where('trash', 0);
    return $query->get();
  }

  public static function getPeoplePaginate(Request $request){
    $query = DB::table('people')->where('trash', 0);
    $peoplePaginated = MPage::paginate($query, $request, 10);
    return $peoplePaginated;
  }

  public function organizations(){
      return $this->belongsToMany('App\Organization');
  }
}
