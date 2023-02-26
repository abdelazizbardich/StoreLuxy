<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class messagesController extends Controller
{
    //
    public function show(){
        $messages = $this->getAllMessages();
        $array = array('messages' => $messages);
        return view('admin.messages.all',$array);
    }

    // get All messages
    public function getAllMessages(){
        $messages = DB::table('contacts')->orderBy('id', 'DESC')->get();
        foreach($messages as $message){
            $subject = $this->getMessageSubject($message->subject_id);
            $message->subject = $subject->name;
        }
        return $messages;
    }

    // get Messages Subject
    public function getMessageSubject($id){
        $subject = DB::table('message_subjects')->where('id',$id)->first();
        return $subject;
    }

    //  Set messages as read
    public function setAsRead($id){
        $message = DB::table('contacts')->where('id',$id)->update(array('state'=>'read'));
        return $this->show();
    }

    //  Set messages as Unread
    public function setAsUnread($id){
        $message = DB::table('contacts')->where('id',$id)->update(array('state'=>'unread'));
        return $this->show();
    }
    
    // Delete message 
    public function deleteMessage($id){
        $message = DB::table('contacts')->delete($id);
        return $this->show();
    }
}
