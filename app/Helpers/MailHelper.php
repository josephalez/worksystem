<?php namespace App\Helpers;

  use Mail;

  class MailHelper {

    public static function sendMail($person,$title="",$desc="",$files=[]){
      //var_dump($desc, $title); exit();
        Mail::send('email.message', ['person' => $person, "title"=>$title, "description"=>$desc], function ($m) 
        use ($person,$files,$title) {
            foreach($files as $file){
              $m->attach($file["path"], array(
                'as' => $file["name"],
                'mime' => $file["mime"])
              );
            }
            $m->to($person->email, $person->firstname)->subject($title);
         });
        
    }

  }

?>
