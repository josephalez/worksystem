<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Helpers\MailHelper;

use Illuminate\Support\Facades\Validator;

use Auth;

use App\Email;

use JWTAuth;

class MailController extends Controller
{
      public function getAllEmails(){
        return Email::getAll();
      }

      public function sendToUsers(Request $request){

        $params=$request->all();
        $lead=false;
        $people=array();
        $people_db=DB::table("people")->get();
        $title="";
        $desc="";
        if(isset($params["title"])&&!empty($params["title"])) $title=$params["title"];

        if(isset($params["description"])&&!empty($params["description"])) $desc=$params["description"];

        foreach($people_db as $person){
          if(isset($params["lead"])&&!empty($params["lead"])){
            $lead=true;
            if($person->lead) array_push($people,$person);
          }
          else {
            array_push($people,$person);
          }
        }
        $files=array();
        if($request->hasFile("files")) {
          $request_files=$request->file("files");
          $validator=Validator::make($request_files,[
            "*" => "file|mimes:jpg,jpeg,pdf,png,zip,ppt,pptx,ppts,doc,docx,xlsx|max:55050"
          ]);
          if($validator->fails()){
            return response()->json("Tipo de archivo no permitido", 400);
          }
          foreach ($request_files as $file) {

            $mime=$file->getMimeType();


            $filename = $file->getClientOriginalName();

            $file->move(public_path('uploads/images'), $filename);

            array_push($files,[
              "path"=>public_path('/uploads/images')."/".$filename,
              "name"=>$filename, // If you want you can chnage original name to custom name
              "mime"=>$mime,
            ]);
          }
        }
        // Comentar esto
        /*return response()->json([
          "people"=>$people,
          "files"=>$files,
        ]);*/
        // Hasta aqui

        if(empty($people))
          return response()->json("No hay usuarios que cumplan con la condicion",200);

        Email::sendEmail($title, $desc, $lead, count($people));
        ini_set('max_execution_time', -1);
        ini_set('max_input_time', -1);
        foreach($people as $person){
          MailHelper::sendMail($person, $title, $desc ,$files);
        }

        return response()->json("Correo enviado exitosamente",200);
      }

      public function reSend($id){
        //validar aqui :v
        return Email::reSend($id);
      }

      public function view($id){
        return Email::increaseViews($id);
      }

}
