<?php

namespace App\Http\Controllers;
use App\Organization;
use App\OrganizationPerson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
  public function create(Request $request){

      //var_dump($request->all());exit();

      //$request['photo'] = '';

      $_request = $request->all();

      $validator = Validator::make($_request, [
        'title' => ['required', 'string', 'min:2', 'max:24'],
        'short_desc' => ['max:92'],
        'long_desc' => ['max:256'],
        'phone' => ['max:16'],
        'email' => ['max:180'],
        'web' => ['max:180'],
      ]);

      if($validator->fails())  return response()->json($validator->errors(), 400);

      $file = $request->file('photo');
      if (!$file) return response()->json(['Foto' => 'La foto es obligatoria.'],400);

      $created = Organization::createOrganization($request);
      if (!$created) return response()->json('Database Error', 500);

      return response()->json('Organization Creada Satisfactoriamente', 200);
    }

    public static function edit(Request $request){
      $_request = $request->all();
      $organization = DB::table('organizations')
      ->where('id', $_request['id'])
      ->first();
      if(!$organization) return response()->json('Organization not found', 404);
      $organization = Organization::find($organization->id);
      if(!$organization) return response()->json('Database Error', 500);
      if (isset($_request['title'])) $organization->title = $_request['title'];
      if (isset($_request['short_desc'])) $organization->short_desc = $_request['short_desc'];
      if (isset($_request['long_desc'])) $organization->long_desc = $_request['long_desc'];
      if (isset($_request['phone'])) $organization->phone = $_request['phone'];
      if (isset($_request['email'])) $organization->email = $_request['email'];
      if (isset($_request['web'])) $organization->web = $_request['web'];
      if (isset($_request['photo'])){
        $file = $_request['photo'];
        $carpetaDestino = 'uploads/organizations';
        $nombreArchivo = 'file_'.uniqid().'_'.$file->getClientOriginalName();
        $urlPhoto = $file->move($carpetaDestino,$nombreArchivo);
        $organization->photo = $urlPhoto;
      }
      $organization->save();
      return response()->json('Organization Changed', 200);
    }

    public static function estado(Request $request)
    {
        $_request = $request->all();
        $organization = DB::table('organizations')
        ->where('id',$_request['id'])
        ->first();
        $estado = DB::table('estados')
        ->where('id',$_request['estado'])
        ->first();
        if(!$organization) return response()->json('Organization not found', 404);
        $organization = Organization::find($organization->id);
        if(!$organization) return response()->json('Database Error', 500);
        $organization->estado = $estado->id;
        $organization->save();
        return response()->json('Organization Contactada', 200);
    }

    public static function remove(Request $request, $id)
    {
      $organization = DB::table('organizations')
      ->where('id', $id)
      ->first();
      if(!$organization) return response()->json('Organization not found', 404);
      $organization = Organization::find($organization->id);
      if(!$organization) return response()->json('Database Error', 500);
      $organization->trash = 1;
      $organization->save();
      return response()->json('Organization Eliminada', 200);
    }

    public static function addPerson(Request $request){
      $_request = $request->all();
      $alreadyExist = DB::table('organization_person')
      ->where('organization_id',$_request['organization'])
      ->where('person_id',$_request['person_id'])
      ->first();
      if ($alreadyExist) return response()->json('Person already added',400);
      $person_id = $_request['person_id'];
      $created = OrganizationPerson::addPerson($request, $person_id);
      if (!$created) return response()->json('Database Error',500);
      return response()->json('Person Succesfully Added',200);
    }

  public function todas(){
    $vertodas = Organization::getOrganizations();
    if (!$vertodas) return response()->json('Database Error', 500);

    return response()->json($vertodas);
  }

  public function projects($id){
    $organization = Organization::find($id);
    if (!$organization) return response('Organization Not Found',404);
    return $organization->projects;
  }

  public function people($id){
    $organization = Organization::find($id);
    if (!$organization) return response('Organization Not Found',404);
    return $organization->people;
  }
}
