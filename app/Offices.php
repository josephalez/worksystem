<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Offices extends Model
{
    use Notifiable;
    protected $fillable = [
        'id',
        'name',
        'location',
    ];

    public static function createOffice(Request $request){
      $_request = $request->all();
      return Office::create([
          'name' => $_request['name'],
          'location' => $_request['location'],
      ]);
    }

    public static function getOffices(){

      $query = DB::table('offices');
      return $query->get();

    }
}
