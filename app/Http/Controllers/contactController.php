<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class contactController extends Controller
{
    //
    public function getForm(){
        $subjects = $this->getSubjects();
        $array = array('subjects' => $subjects);
        return view("Contact",$array);
    }
    public function getSubjects(){
        $Subjects = DB::table('message_subjects')->get();
        return $Subjects;
    }
    public function sendMessage(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                
                'fullname' => 'required|min:2',
                'email' => 'required|email',
                'subject' => 'required|min:1|max:2',
                'message' => 'required|min:20',
            ],
            [
                'fullname.required' => 'Le nom complet est obligatoire',
                'fullname.min' => 'Le nom complet doit contenir au moins 2 caractères',

                'email.required' => 'L\'adresse e-mail est obligatoire',
                'email.email' => 'L\'e-mail doit être une adresse e-mail valide',
                
                'subject.required' => 'Sélectionner un sujet',
                'message.required' => 'Le message est obligatoire',
                'message.min' => 'Le message doit contenir au moins 20 caractères',
            ]);
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){return 0;} 
        $fullname = $request->fullname;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        if(DB::insert('insert into contacts (full_name,email,subject_id,message,created_at) values (?,?,?,?,?)', [$fullname,$email,$subject,$message,now()])){
            $subjects = $this->getSubjects();
            $array = array('subjects' => $subjects,'success'=> 'Votre message a été envoyé avec succès, Merci');
            return view("Contact",$array);
        }else{
            $subjects = $this->getSubjects();
            $array = array('subjects' => $subjects,'error'=> 'Impossible d\'envoyer un message!');
            return view("Contact",$array);
        }
        }
        
    }
}
