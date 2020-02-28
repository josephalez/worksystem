<?php

namespace App;

use Illuminate\Support\Facades\DB;
use App\Helpers\MailHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class Email extends Model
{
    use Notifiable;


    protected $fillable = [
        'id',
        'sent',
        'title',
        'description',
        'lead',
        'views',
    ];

    protected $table = 'emails';

    public static function sendEmail($title, $desc,$lead,$count){
      var_dump($count); exit(); //ESTO ES PARA VER EL CONTEO QUE SE PASA EN EL CONTROLADOR DE A CUANTOS SE ENVIA
        return Email::create([
            'title' => $title,
            'description'=> $desc,
            'lead'=> $lead,
            "sent"=>$count
        ]);
    }

    public static function increaseViews($id){
        $email= Email::find($id);
        if(!$email) return response()->json("El id es inválido",400);

        $email->views++;
        if($email->save()){
            return response()->json("actualizacion exitosa",200);//aqui retornamos la imagen no??
        }

        return response()->json("Error", 500);

    }

    public static function reSend($id){
        $email= Email::find($id);
        if(!$email) return response()->json("El id es inválido",400);

        $people_db=DB::table("people")->get();
        foreach($people_db as $person){
          if($email->lead){
            if($person->lead) MailHelper::sendMail($person,$email->title,$email->description);
          }
          else {
            if($person)
            MailHelper::sendMail($person,$email->title,$email->description);
          }
        }

        if($email->save()){
            return response()->json("actualizacion exitosa",200);
        }

        return response()->json("Error", 500);

    }

    public static function getAll(){
        return Email::get()->where('trash', 0);
    }

}
