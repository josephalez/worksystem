<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\OrganizationPerson;
use App\Helpers\MPage;

class PersonController extends Controller
{
    public function create(Request $request){
        $_request = $request->all();
        $validator = Validator::make($request->all(), [
          'firstname' => ['required', 'string', 'min:2', 'max:32'],
          'lastname' => ['required', 'string', 'min:2', 'max:32'],
          'email' => ['required', 'string', 'max:180'],
          'phone' => ['string', 'min:11', 'max:16'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $created = Person::createPerson($request);
        if (!$created) return response()->json('Database Error', 500);
        if(isset($_request['organization'])){
          $person_id = $created->id;
          $person_created = OrganizationPerson::addPerson($request,$person_id);
          if(!$person_created) return response()->json('Database Error', 500);
        }
        return response()->json('Person Successfully Created', 200);
    }

    public function formCreate(Request $request){
      $params = $request->all();
      $name = explode(" ",$params['name']);
      if(isset($name[0])) {
        $params['firstname'] = $name[0];
      }else {
        $params['firstname'] = null;
      };

      $validator = Validator::make($params, [
        'firstname' => ['required', 'string', 'min:2', 'max:32'],
        'lastname' => ['string', 'min:2', 'max:32'],
        'email' => 'required|email|string|max:180',
        'phone' => ['string', 'min:11', 'max:16'],
        'message' => "string|min:4|max:255",
      ]);
      if($validator->fails()){
        return response()->json($validator->errors(), 400);
      }
      $person=DB::table("people")->where("email", $params["email"])->first();

      if($person){
        $person=Person::find($person->id);
        if(!$person->lead) return response()->json("Esta persona fue creada desde el panel", 403);
        if(isset($name[0])) $person->firstname= $name[0];
        if(isset($name[1])) $person->lastname= $name[1];
        if(isset($params["phone"])) $person->phone= $params["phone"];
        if(isset($params["message"])) $person->message= $params["message"];
        if(!$person->save()) return response()->json('Database Error', 500);
      }else{
        if(isset($name[1])) {
          $params["lastname"] = $name[1];
        }else {
          $params["lastname"] = null;
        };
        if(!isset($params["phone"])) $params["phone"] = null;
        if(!isset($params["message"])) $params["message"] = null;
        $person= Person::create([
          "firstname"=> $params["firstname"],
          "lastname"=> $params["lastname"],
          "email"=> $params["email"],
          "phone"=> $params["phone"],
          "message"=> $params["message"],
          "lead" => true,
        ]);
      }
      return response()->json("Tu mensaje ha sido enviado", 200);
  }

    public static function remove(Request $request, $id){
      $_request = $request->all();
      $person = DB::table('people')->where('id', $id)->first();
      if(!$person) return response()->json('Person not found', 404);
      $person = Person::find($person->id);
      if(!$person) return response()->json('Database Error', 500);
      $person->trash = 1;
      $person->save();
      return response()->json('Person Removed', 200);
    }
    /*public static function getByOrganization($organization){
      $people = DB::table('people')
      ->where('trash', 0)
      ->where('organization',$organization);
      if(!$people) return response()->json('Database Error', 500);
      return $people->get();
    }*/

    public function paginate(Request $request){
      $people = Person::getPeoplePaginate($request);
      return response()->json($people);
    }

    public function get(){
      $people = Person::getPeople();
      if (!$people) return response()->json('Database Error', 500);
      return response()->json($people);
    }

    public function organizations($id){
      $person = Person::find($id);
      if (!$person) return response('Person Not Found',404);
      return $person->organizations;
    }
}
