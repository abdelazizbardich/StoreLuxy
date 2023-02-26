<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class shopController extends Controller
{
    //
    public function getShop(){
        // Categorys
        $Category = $this->getCategorys();
        $Products = $this->getAllProducts();
        $array = array('categorys' => $Category, 'products' => $Products);
        return view('shop',$array);
    }
    public function getShopCategoty($name){
        $Category = $this->getCategorys();
        $Products = $this->getAllProductsByCategory($name);
        $array = array('categorys' => $Category, 'products' => $Products);
        return view('shop',$array);
    }
    public function getCategorys(){

        $Categorys = DB::table('categorys')->where('type','category')->get();
        $CategorysArray= [];
        foreach($Categorys as $Category){
            $CategoryArray = (object)[];
            // set categorys
            $CategoryArray->category = $Category;
            // set thumbnail
            $thumbnail = DB::table('medias')->where('id',$Category->thumbnail)->first();
            $CategoryArray->thumbnail = (object)$thumbnail;
            // Sub categorys
                $SubCategorys = DB::table('categorys')->where('type','sub_category')->where('parent',$Category->id)->get();
                $SubCategorysArray= [];
                foreach($SubCategorys as $SubCategory){
                    $SubCategoryArray = (object)[];
                    // set categorys
                    $SubCategoryArray->category = $SubCategory;
                    // set thumbnail
                    $thumbnail = DB::table('medias')->where('id',$SubCategory->thumbnail)->first();
                    $SubCategoryArray->thumbnail = $thumbnail;

                        // sub sub Category
                        $subSubCategorys = DB::table('categorys')->where('type','sub_sub_category')->where('parent',$SubCategory->id)->get();
                        $subSubCategorysArray= [];
                        foreach($subSubCategorys as $subSubCategory){
                            $subSubCategoryArray = (object)[];
                            // set categorys
                            $subSubCategoryArray->category = $subSubCategory;
                            // set thumbnail
                            $thumbnail = DB::table('medias')->where('id',$subSubCategory->thumbnail)->first();
                            $subSubCategoryArray->thumbnail = $thumbnail;
                            array_push($subSubCategorysArray,$subSubCategoryArray);
                        }
                        $SubCategoryArray->subSubCategorys = $subSubCategorysArray;


                    array_push($SubCategorysArray,$SubCategoryArray);
                }
                $CategoryArray->subCategorys = $SubCategorysArray;

            array_push($CategorysArray,$CategoryArray);
        }
        return $CategorysArray;

    }

    public function getAllProducts(){
        $Products = DB::table('products')->where('state','1')->where('state','1')->paginate(8);
        $i = 0;

        foreach($Products as $Product){
            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$Product->thumbnail_id)->first();
            $Products[$i]->thumbnail = $thumbnail;

            // Gallery
            $gallerys_ids = explode(',',$Product->gallery_ids);
            $photos = array();
            foreach($gallerys_ids as $gallery_id){
                $photo = DB::table('medias')->where('id',$gallery_id)->first();
                if($photo != null) : array_push($photos,$photo); endif;
            }
            $Products[$i]->photos = (object)$photos;

            // Categorys
            $Categorys_ids = explode(',',$Product->categorys_ids);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->first();
                array_push($categorys,$category);
            }
            $Products[$i]->categorys = (object)$categorys;

            // reviews
            $reviews = DB::table('reviews')->where('product_id',$Product->id)->get();
            $reviewStarsCount = 0;
            $reviewStarsAverage = 0.00;
            foreach($reviews as $review){
                $reviewStars = $review->stars;
                $reviewStarsCount += $reviewStars;
            }
            $reviewStarsAverage = ($reviewStarsCount>0)?$reviewStarsCount/count($reviews):0;
            $Products[$i]->stars = $reviewStarsAverage;
            $i++;
        }

        return $Products;
    }

    public function getAllProductsByCategory($name){
        $Products = DB::table('products')->where('state','1')->paginate(8);
        $i = 0;
        $calledCategoey_id = DB::table('categorys')->where('slug_name',$name)->first();
        foreach($Products as $Product){
            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$Product->thumbnail_id)->first();
            $Products[$i]->thumbnail = $thumbnail;

            // Gallery
            $gallerys_ids = explode(',',$Product->gallery_ids);
            $photos = array();
            foreach($gallerys_ids as $gallery_id){
                $photo = DB::table('medias')->where('id',$gallery_id)->first();
                if($photo != null) : array_push($photos,$photo); endif;
            }
            $Products[$i]->photos = (object)$photos;

            // Categorys
            $Categorys_ids = explode(',',$Product->categorys_ids);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->first();
                array_push($categorys,$category);
            }
            $Products[$i]->categorys = (object)$categorys;

            // reviews
            $reviews = DB::table('reviews')->where('product_id',$Product->id)->get();
            $reviewStarsCount = 0;
            $reviewStarsAverage = 0.00;
            foreach($reviews as $review){
                $reviewStars = $review->stars;
                $reviewStarsCount += $reviewStars;
            }
            @$reviewStarsAverage = $reviewStarsCount/count($reviews);
            $Products[$i]->stars = $reviewStarsAverage;

            if(in_array($calledCategoey_id->id,$Categorys_ids) != null){

            }else{unset($Products[$i]);
            }

            $i++;
        }

        return $Products;
    }

    public function getShopSubCategoty($name,$subname){

        $Products = DB::table('products')->where('state','1')->paginate(8);
        $i = 0;
        $calledCategoey_id = DB::table('categorys')->where('slug_name',$name)->first();
        $SubcalledCategoey_id = DB::table('categorys')->where('slug_name',$subname)->where('parent',$calledCategoey_id->id)->first();
        foreach($Products as $Product){
            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$Product->thumbnail_id)->first();
            $Products[$i]->thumbnail = $thumbnail;

            // Gallery
            $gallerys_ids = explode(',',$Product->gallery_ids);
            $photos = array();
            foreach($gallerys_ids as $gallery_id){
                $photo = DB::table('medias')->where('id',$gallery_id)->first();
                if($photo != null) : array_push($photos,$photo); endif;
            }
            $Products[$i]->photos = (object)$photos;

            // Categorys
            $Categorys_ids = explode(',',$Product->categorys_ids);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->first();
                array_push($categorys,$category);
            }
            $Products[$i]->categorys = (object)$categorys;

            // reviews
            $reviews = DB::table('reviews')->where('product_id',$Product->id)->get();
            $reviewStarsCount = 0;
            $reviewStarsAverage = 0.00;
            foreach($reviews as $review){
                $reviewStars = $review->stars;
                $reviewStarsCount += $reviewStars;
            }
            @$reviewStarsAverage = $reviewStarsCount/count($reviews);
            $Products[$i]->stars = $reviewStarsAverage;

            if(in_array($calledCategoey_id->id,$Categorys_ids) != null){
                if(in_array($SubcalledCategoey_id->id,$Categorys_ids) != null){

                }else{unset($Products[$i]);
                }
            }else{unset($Products[$i]);
            }

            $i++;
        }

        $Category = $this->getCategorys();
        $array = array('categorys' => $Category, 'products' => $Products);
        return view('shop',$array);
    }

    //
    public function getShopSubSubCategoty($name,$subname,$subsubname){

        $Products = DB::table('products')->where('state','1')->paginate(8);
        $i = 0;
        $calledCategoey_id = DB::table('categorys')->where('slug_name',$name)->first();
        $SubcalledCategoey_id = DB::table('categorys')->where('slug_name',$subname)->where('parent',$calledCategoey_id->id)->first();
        $SubSubcalledCategoey_id = DB::table('categorys')->where('slug_name',$subsubname)->where('parent',$SubcalledCategoey_id->id)->first();
        foreach($Products as $Product){
            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$Product->thumbnail_id)->first();
            $Products[$i]->thumbnail = $thumbnail;

            // Gallery
            $gallerys_ids = explode(',',$Product->gallery_ids);
            $photos = array();
            foreach($gallerys_ids as $gallery_id){
                $photo = DB::table('medias')->where('id',$gallery_id)->first();
                if($photo != null) : array_push($photos,$photo); endif;
            }
            $Products[$i]->photos = (object)$photos;

            // Categorys
            $Categorys_ids = explode(',',$Product->categorys_ids);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->first();
                array_push($categorys,$category);
            }
            $Products[$i]->categorys = (object)$categorys;

            // reviews
            $reviews = DB::table('reviews')->where('product_id',$Product->id)->get();
            $reviewStarsCount = 0;
            $reviewStarsAverage = 0.00;
            foreach($reviews as $review){
                $reviewStars = $review->stars;
                $reviewStarsCount += $reviewStars;
            }
            @$reviewStarsAverage = $reviewStarsCount/count($reviews);
            $Products[$i]->stars = $reviewStarsAverage;

            if(in_array($calledCategoey_id->id,$Categorys_ids) != null){
                if(in_array($SubcalledCategoey_id->id,$Categorys_ids) != null){
                    if(in_array($SubSubcalledCategoey_id->id,$Categorys_ids) != null){

                    }else{unset($Products[$i]);}
                }else{unset($Products[$i]);}
            }else{unset($Products[$i]);}

            $i++;
        }

        $Category = $this->getCategorys();
        $array = array('categorys' => $Category, 'products' => $Products);
        return view('shop',$array);
    }
}
