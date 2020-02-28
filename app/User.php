<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', "blacklist", "role", "member"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function fecthUserData(Request $request){
        $_request=$request->all();
        if(!isset($_request['member'])) $_request['member'] = null;
        return User::create([
            "username" => $_request["username"],
            "password" => Hash::make($_request['password']),
            "blacklist" => 0,
            "role" => $_request["role"],
            "member" => $_request['member']
        ]);
    }

    public static function getMemberObjectAttribute(){
      $member = DB::table('members')->find($this->member);

      $response = ['person' => ['firstname' => 'No existe.']];

      if ($member) {
        $person = DB::table('people')->find($member->person);
        $response['member'] = $member;
        if ($person)
          $response['member']['person'] = $person;
        else
          $response['member']['person'] = ['firstname' => 'No existe.'];
      }

      return $response;
    }

    public static function getAll(){
      $query = DB::table('users');
      return $query->get();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }



}
