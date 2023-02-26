<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class postController extends Controller
{
    //
    public function getPost($name){
        $Post =  DB::table('posts')->where('slug_name',$name)->where('state', 'published')->first();
        $PostDataArray = [];
        $arr = (object)[];
        // post
        $arr->post = $Post;
        // thumbnail
        $thumbnail = DB::table('medias')->where('id',$Post->thumbnail)->first();
        $arr->thumbnail = $thumbnail;

        // Categorys
        $Categorys_ids = explode(',',$Post->categorys);
        $categorys = [];
        foreach($Categorys_ids as $Category_id){
            $category = DB::table('categorys')->where('id',$Category_id)->first();
            array_push($categorys,$category);
        }
        $arr->categorys = (object)$categorys;

        // Comments
        $Comments = DB::table('comments')->where('post_id',$Post->id)->where('state','approved')->get();
        $CommentsData = [];
        foreach($Comments as $Comment){
            $commentArray = (object)[];
            $commentArray->comment = $Comment;
            //$User = DB::table('users')->where('id',$Comment->post_id)->first();
            $commentArray->user = $Comment->name;
            array_push($CommentsData,$commentArray);
        }
        $arr->comments = $CommentsData;
        // comments count
        $arr->commentsCount = count($CommentsData); 
        // User
        $User = DB::table('users')->where('id',$Post->user_id)->first();
        $arr->user = $User->username;

        //
        $Tags = explode(',',$Post->tags);
        $RelatedPosts = $this->getReleatedProsts($Categorys_ids,$Tags,$Post->id);

        // update views
        $this->addNewView($arr->post->views,$Post->id);

        // push all
        $PostDataArray = $arr;
        $array = array('Post' => $PostDataArray, 'RelatedPosts' => $RelatedPosts);
        return view('post',$array);
    }
    public function addNewView($views,$id){
        $views++;
        DB::update('update posts set views = '.$views.' where id = ?', [$id]);
    }
    public function getReleatedProsts($categorys,$tags,$thidId){
        $Posts =  DB::table('posts')->where('state', 'published')->get();
        $PostsDataArray = [];
        foreach($Posts as $Post){
            $isReleated =false;
            $Thiscategorys = explode(',',$Post->categorys);
            foreach($Thiscategorys as $Thiscategory){
                if(in_array($Thiscategory,$categorys)){
                    $isReleated = true;
                }
            }
            $ThisTags = explode(',',$Post->tags);
            foreach($ThisTags as $ThisTag){
                if(in_array($ThisTag,$tags)){
                    $isReleated = true;
                }
            }
            $HasSameId = $Post->id == $thidId;
            if(!$HasSameId && $isReleated){
                $arr = (object)[];
                // post
                $arr->post = $Post;
                // thumbnail
                $thumbnail = DB::table('medias')->where('id',$Post->thumbnail)->first();
                $arr->thumbnail = $thumbnail;

                // Categorys
                $Categorys_ids = explode(',',$Post->categorys);
                $categorys = [];
                foreach($Categorys_ids as $Category_id){
                    $category = DB::table('categorys')->where('id',$Category_id)->first();
                    array_push($categorys,$category);
                }
                $arr->categorys = (object)$categorys;

                // Comments
                $Comments = DB::table('comments')->where('post_id',$Post->id)->where('state','approved')->get();
                $arr->commentsCount = count((array)$Comments); 
                
                // User
                $User = DB::table('users')->where('id',$Post->user_id)->first();
                $arr->user = $User->username;
                // push all
                array_push($PostsDataArray,$arr);
            }
        }
        return $PostsDataArray;
    }
    public function addComment(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                'fullname' => 'required|min:2',
                'comment' => 'required|min:2',
            ],            [
                'fullname.required' => 'Le nom est obligatoire',
                'fullname.min' => 'Le nom doit contenir au moins 2 caractères',

                'comment.required' => 'Le commentaire est obligatoire',
                'comment.min' => 'Le commentaire est obligatoire',
            ]);
            $name = $request->fullname;
            $comment = $request->comment;
            $id = $request->id;
            $now = now();
            DB::insert('insert into comments (name,comment,post_id,created_at) values (?,?,?,?)', [$name,$comment,$id,$now]);
            return redirect()->back()->with('success', ['your message,here']);
        }
    }
}