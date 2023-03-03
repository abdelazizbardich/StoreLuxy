<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class postsController extends Controller
{
    //
    public function show(){
        $posts = $this->getPostsData();
        $array = array('posts' => $posts);
        return view('admin.posts.all',$array);
    }

    // Get All Posts Data
    private function getPostsData(){
        $posts = DB::table('posts')->orderBy('id', 'DESC')->get();
        foreach($posts as $post){
            $user = $this->getPostAuthor($post->user_id);
            $post->author = @$user->username;

            $categoriesIds = explode(',',$post->categorys);
            $categoriesData = [];
            foreach($categoriesIds as $categoryId){
                $categories = $this->getPostCategory($categoryId);
                array_push($categoriesData,$categories);
            }
            $post->categories = $categoriesData;
            $post->commentsCount = $this->getPostCommentsCount($post->id);
        }
        return $posts;
    }

    // Get Post Author Data
    public function getPostAuthor($id){
        $user = DB::table('users')->where('id',$id)->first();
        return $user;
    }

    // Get Post category

    public function getPostCategory($id){
        $category = DB::table('categorys')->where('id',$id)->where('type','post_category')->first();
        return $category;
    }

    //* get Post comments

    private function getPostCommentsCount($id){
        $comments = DB::table('comments')->where('post_id',$id)->get();
        return count($comments);
    }

    // Move post ot draft
    public function moveToDraft($id){
        $post = DB::table('posts')->where('id',$id)->update(array('state'=>'draft'));
        return $this->show();
    }

    // Move post to published

    public function moveTopublished($id){
        $post = DB::table('posts')->where('id',$id)->update(array('state'=>'published'));
        return $this->show();
    }

    // Get podt for editting

    public function getPostForEdit($id){
        $post = $this->getSinglePostsData($id);
        $categories = $this->getcategories();
        $thumbnail = $this->getPostThumbnail($post->thumbnail);
        $array = array('post' => $post, 'categories' => $categories,'thumbnail' => $thumbnail);
        return view('admin.posts.edit',$array);
    }

    // get single post data
    private function getSinglePostsData($id){
        $post = DB::table('posts')->where('id', $id)->first();
            $user = $this->getPostAuthor($post->user_id);
            $post->author = $user->username;
            $post->categorysIds = $post->categorys;
            $categoriesIds = explode(',',$post->categorys);
            $categoriesData = [];
            foreach($categoriesIds as $categoryId){
                $categories = $this->getPostCategory($categoryId);
                array_push($categoriesData,$categories);
            }
            $post->categories = $categoriesData;
            if($post->tags !== null){
                $tags = explode(',',$post->tags);
                $tagsData = [];
                foreach($tags as $tag){
                    $tag = trim($tag);
                    array_push($tagsData,$tag);
                }
            }else {
                $tagsData = [''];
            }
            $post->tagsObjects = $tagsData;
            $post->commentsCount = $this->getPostCommentsCount($post->id);

        return $post;
    }

    // Get posts categories
    private function getcategories(){
        $categories = DB::table('categorys')->where('type','post_category')->orderBy('id','DESC')->get();
        return $categories;
    }

    // Get single posts categories
    private function getSinglecategories($id){
        $categories = DB::table('categorys')->where('id',$id)->where('type','post_category')->orderBy('id','DESC')->first();
        return $categories;
    }

    // get Post thumbnail
    private function getPostThumbnail($id){
        $thumbnail = DB::table('medias')->where('id',$id)->first();
        return $thumbnail;
    }

    // Edit post
    public function editPost(Request $request){
        if(isset($request->save)){
            $categories = '';
            $i=0;
            foreach($request->categories as $category){
                if($i== 0){$categories = $categories.$category;}else{$categories = $categories.','.$category;}
                $i = 1;
            }
            $data = array(
                'type' => $request->type,
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'content' => $request->content,
                'views' => $request->views,
                'shares' => $request->shares,
                'tags' => $request->tags,
                'categorys' => $categories,
                'thumbnail' => $request->thumbnail,
                'state' => 'draft',
                'updated_at' => now()
            );
            $post = DB::table('posts')->where('id',$request->id)->update($data);
            return $this->show();
        }elseif(isset($request->publish)){
            $categories = '';
            $i=0;
            if(isset($request->categories)){
                foreach($request->categories as $category){
                    if($i== 0){$categories = $categories.$category;}else{$categories = $categories.', '.$category;}
                    $i = 1;
                }
            }else {$categories = '';}
            $data = array(
                'type' => $request->type,
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'content' => $request->content,
                'views' => $request->views,
                'shares' => $request->shares,
                'tags' => $request->tags,
                'categorys' => $categories,
                'thumbnail' => $request->thumbnail,
                'state' => 'published',
                'updated_at' => now()
            );
            $post = DB::table('posts')->where('id',$request->id)->update($data);
            return $this->show();
        }
    }

    public function NewPost(){
        $categories = $this->getcategories();
        $array = array('categories' => $categories);
        return view('admin.posts.add-new',$array);
    }

    public function addNewPost(Request $request){
        if(isset($request->save)){
            $categories = '';
            $i=0;
            foreach($request->categories as $category){
                if($i== 0){$categories = $categories.$category;}else{$categories = $categories.','.$category;}
                $i = 1;
            }
            $post = DB::table('posts')->insertGetId([
                'type' => $request->type,
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'content' => $request->content,
                'views' => $request->views,
                'shares' => $request->shares,
                'tags' => $request->tags,
                'categorys' => $categories,
                'thumbnail' => $request->thumbnail,
                'state' => 'draft',
                'created_at' => now()
            ]);
            return $this->show();
        }elseif(isset($request->publish)){
            $categories = '';
            $i=0;
            if(isset($request->categories)){
                foreach($request->categories as $category){
                    if($i== 0){$categories = $categories.$category;}else{$categories = $categories.', '.$category;}
                    $i = 1;
                }
            }else {$categories = '';}
            $post = DB::table('posts')->insertGetId([
                'type' => $request->type,
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'content' => $request->content,
                'views' => $request->views,
                'shares' => $request->shares,
                'tags' => $request->tags,
                'categorys' => $categories,
                'thumbnail' => $request->thumbnail,
                'state' => 'published',
                'created_at' => now()
            ]);
            return $this->show();
        }
    }

    // get Blog Categorys

    public function getBlogCategories(){
        $categories = $this->getcategories();
        $array = array('categories' => $categories);
        return view('admin.posts.categories',$array);
    }

    // add New Categort
    public function addNewCategory(Request $request){
        $category = DB::table('categorys')->insertGetId([
            'name' => $request->title,
            'slug_name' => $request->sub_title,
            'car_desc' => $request->description,
            'type' => 'post_category',
            'thumbnail' => $request->thumbnail,
            'created_at' => now()
        ]);
        $categories = $this->getcategories();
        $array = array('categories' => $categories);
        return view('admin.posts.categories',$array);
    }

    // get Post Category for edit
    public function getCategoryForEdit($id){
        $categories = $this->getcategories();
        $thisCategory = $this->getSinglecategories($id);
        $thisCategory->thumbnail = $this->getPostThumbnail($thisCategory->thumbnail);
        $array = array('categories' => $categories, 'thisCategory' => $thisCategory);
        return view('admin.posts.modifier-categorie',$array);
    }

    // edti Category

    public function editCategory(Request $request){
        $category = DB::table('categorys')->where('id',$request->id)->update([
            'name' => $request->title,
            'slug_name' => $request->sub_title,
            'car_desc' => $request->description,
            'type' => 'post_category',
            'thumbnail' => $request->thumbnail,
            'updated_at' => now()
        ]);
        $categories = $this->getcategories();
        $array = array('categories' => $categories);
        return view('admin.posts.categories',$array);
    }

    public function deleteCategory($id){
        $category = DB::table('categorys')->delete($id);
        return $this->getBlogCategories();
    }
}
