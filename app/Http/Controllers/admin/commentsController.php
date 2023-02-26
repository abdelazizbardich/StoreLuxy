<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class commentsController extends Controller
{
    //
    public function show(){
        $comments = $this->getCommentsData();
        $array = array(
            'comments' => $comments
        );
        return view('admin.comments.all',$array);
    }

    // get comments Data
    public function getCommentsData(){
        $comments = DB::table('comments')->orderBy('id', 'DESC')->get();
        foreach($comments as $comment){
            $commentsedPost = $this->getPostById($comment->post_id);
            $comment->post = $commentsedPost;
        }
        return $comments;
    }
    // get postName by id
    public function getPostById($id){
        $post = DB::table('posts')->where('id',$id)->first();
        return $post;
    }

    // Approve comment
    public function approveComment($id){
        $comment = DB::table('comments')->where('id',$id)->update(array('state'=>'approved','updated_at'=>now()));
        return $this->show();
    }

    // Disapprove comment
    public function disapproveComment($id){
        $comment = DB::table('comments')->where('id',$id)->update(array('state'=>'pending','updated_at'=>now()));
        return $this->show();
    }

    // Delete comment

    public function deleteComment($id){
        $comment = DB::table('comments')->delete($id);
        return $this->show();
    }
}
