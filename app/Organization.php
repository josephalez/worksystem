<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Organization extends Model
{
    use Notifiable;
    protected $fillable = [
        'id',
        'title',
        'short_desc',
        'long_desc',
        'phone',
        'photo',
        'email',
        'estado',
        'web',
        'trash',
    ];

    public static function createOrganization(Request $request){

      $_request = $request->all();
      $file = $_request['photo'];
      $carpetaDestino = 'uploads/organizations';

      $nombreArchivo = 'file_'.uniqid().'_'.$file->getClientOriginalName();
      $urlPhoto = $file->move($carpetaDestino,$nombreArchivo);

      return Organization::create([
          'title' => $_request['title'],
          'short_desc' => (isset($_request['short_desc'])) ? $_request['short_desc'] : null,
          'long_desc' => (isset($_request['long_desc'])) ? $_request['long_desc'] : null,
          'phone' => (isset($_request['phone'])) ? $_request['phone'] : null,
          'email' => (isset($_request['email'])) ? $_request['email'] : null,
          'photo' => $urlPhoto,
          'web' => (isset($_request['web'])) ? $_request['web'] : null,
      ]);

    }

    public static function getOrganizations(){
      $query = DB::table('organizations')
      ->where('trash', 0);
      return $query->get();
    }

    public function projects(){
        return $this->belongsToMany('App\Project');
    }
    public function people(){
        return $this->belongsToMany('App\Person');
    }
}
