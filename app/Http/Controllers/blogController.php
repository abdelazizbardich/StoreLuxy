<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class blogController extends Controller
{
    //
    public function getBlogs(){
        $Posts = $this->getPosts();
        $Categorys = $this->getBlogCategoty();
        $array = array('posts' =>$Posts,'categorys' => $Categorys);
        return view('blogs',$array);
    }
    public function getByCategory($name){
        $Posts = $this->getBlogsByCatrgory($name);
        $Categorys = $this->getBlogCategoty();
        $array = array('posts' =>$Posts,'categorys' => $Categorys);
        return view('blogs',$array);
    }
    //
    public function getBlogsByCatrgory($name){

        $Posts =  DB::table('posts')->where('state', 'published')->paginate(9);

        $calledCategoey_id = DB::table('categorys')->where('slug_name',$name)->first();
        $i = 0;
        foreach($Posts as $Post){
            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$Post->thumbnail)->first();
            $Posts[$i]->thumbnail = (object)$thumbnail;

            // Categorys
            $Categorys_ids = explode(',',$Post->categorys);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->first();
                array_push($categorys,$category);
            }
            $Posts[$i]->categorys = (object)$categorys;

            // Comments
            $Comments = DB::table('comments')->where('post_id',$Post->id)->where('state','approved')->get();
            $Posts[$i]->commentsCount = count((array)$Comments); 
            
            // User
            $User = DB::table('users')->where('id',$Post->user_id)->first();
            $Posts[$i]->user = $User->username;

            if(in_array($calledCategoey_id->id,$Categorys_ids) != null){}else{unset($Posts[$i]);};

            $i++;
        }
        return $Posts;
    }
    public function getPosts(){
        $Posts =  DB::table('posts')->where('state', 'published')->paginate(9);
        $i = 0;
        foreach($Posts as $Post){
            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$Post->thumbnail)->first();
            $Posts[$i]->thumbnail = (object)$thumbnail;

            // Categorys
            $Categorys_ids = explode(',',$Post->categorys);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->first();
                array_push($categorys,$category);
            }
            $Posts[$i]->categorys = (object)$categorys;

            // Comments
            $Comments = DB::table('comments')->where('post_id',$Post->id)->where('state','approved')->get();
            $Posts[$i]->commentsCount = count((array)$Comments); 
            
            // User
            $User = DB::table('users')->where('id',$Post->user_id)->first();
            $Posts[$i]->user = $User->username;
            $i++;
        }
        return $Posts;
    }
    public function getBlogCategoty(){
        $categorys = DB::table('categorys')->where('type','post_category')->get();
        return $categorys;
    }
}
