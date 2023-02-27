<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class homeController extends Controller
{
    //
    public function getHome(){
        $SliderProducts = $this->getSliderProducts();
        $Categorys = $this->getCategorys();
        $Banners = $this->getBanners();
        $TrendingProducts = $this->getTrendingProducts();
        $BestSallerProducts = $this->getbestsallerProducts();
        $Last3Posts = $this->getLast3Posts();
        $Cards = $this->getCards();
        $array = array('SliderProducts' => $SliderProducts, 'categorys' => $Categorys, 'banners' => $Banners, 'TrendingProducts'=> $TrendingProducts, 'BestSallerProducts' => $BestSallerProducts, 'Last3Posts' => $Last3Posts, 'Cards' => $Cards);
        return view('home',$array);
    }

    public function getSliderProducts(){
        //
        $Products = DB::table('products')->where('state','1')->where('in_slider', 1)->get();
        $Productsdata = [];
        foreach($Products as $Product){
            $arr = (object)array();
            $thumbnail = DB::table('medias')->where('id', $Product->slider_thumbnail_id)->first();
            // push thumbnail to product
            $arr->Product = $Product;
            $arr->Thumbnail = $thumbnail;


            // reviews
            $reviews = DB::table('reviews')->where('product_id',$Product->id)->get();
            $reviewStarsCount = 0;
            $reviewStarsAverage = 0.00;
            foreach($reviews as $review){
                $reviewStars = $review->stars;
                $reviewStarsCount += $reviewStars;
            }
            @$reviewStarsAverage = ($reviewStarsCount>0)?$reviewStarsCount/count($reviews):0;
            $arr->stars = $reviewStarsAverage;

            // Categoru
            $Categorys_ids = explode(',',$Product->categorys_ids);
            $PCategorys = [];
            foreach($Categorys_ids as $Categorys_id){
                $PCategory = DB::table('categorys')->where('id',$Categorys_id)->first();
                array_push($PCategorys,$PCategory);
            }
            $arr->categorys = $PCategorys;



            array_push($Productsdata,$arr);

        }
        return $Productsdata;
    }

    public function getCategorys(){
        $Categorys = DB::table('categorys')->where('type','category')->where('in_home',1)->get();
        $CategorysArray= [];
        foreach($Categorys as $Category){
            $CategoryArray = (object)[];
            // set categorys
            $CategoryArray->category = $Category;
            // set thumbnail
            $thumbnail = DB::table('medias')->where('id',$Category->thumbnail)->first();
            $CategoryArray->thumbnail = $thumbnail;

            array_push($CategorysArray,$CategoryArray);
        }
        return $CategorysArray;
    }

    public function getBanners(){
        $Banners = DB::table('banners')->get();
        $BannersArray= [];
        foreach($Banners as $Banner){
            $BannerArray = (object)[];
            // set categorys
            $BannerArray->Banner = $Banner;
            // set thumbnail
            $icon = DB::table('medias')->where('id',$Banner->icon)->first();
            $BannerArray->icon = $icon;

            array_push($BannersArray,$BannerArray);
        }
        return $BannersArray;
    }

    public function getTrendingProducts(){
        $TrendingProducts = DB::table('products')->where('state','1')->where('is_trend', 1)->get();
        $TrendingProductsData = [];
        foreach($TrendingProducts as $TrendingProduct){

            $arr = (object)[];

            // Produc
            $arr->product = $TrendingProduct;

            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$TrendingProduct->thumbnail_id)->first();
            $arr->thumbnail = $thumbnail;

            // Gallery
            $gallerys_ids = explode(',',$TrendingProduct->gallery_ids);
            $photos = array();
            foreach($gallerys_ids as $gallery_id){
                $photo = DB::table('medias')->where('id',$gallery_id)->first();
                if($photo != null) : array_push($photos,$photo); endif;
            }
            $arr->photos = (object)$photos;

            // Categorys
            $Categorys_ids = explode(',',$TrendingProduct->categorys_ids);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->first();
                array_push($categorys,$category);
            }
            $arr->categorys = (object)$categorys;

            // reviews
            $reviews = DB::table('reviews')->where('product_id',$TrendingProduct->id)->get();
            $reviewStarsCount = 0;
            $reviewStarsAverage = 0.00;
            foreach($reviews as $review){
                $reviewStars = $review->stars;
                $reviewStarsCount += $reviewStars;
            }
            @$reviewStarsAverage = ($reviewStarsCount>0)?$reviewStarsCount/count($reviews):0;
            $arr->stars = $reviewStarsAverage;

            // push
            array_push($TrendingProductsData,$arr);
        }
        return $TrendingProductsData;
    }

    public function getbestsallerProducts(){
        $BestSallaerProducts = DB::table('products')->where('state','1')->where('is_best_saller', 1)->get();
        $BestSallaerProductsData = [];
        foreach($BestSallaerProducts as $BestSallaerProduct){

            $arr = (object)[];

            // Produc
            $arr->product = $BestSallaerProduct;

            // thumbnail
            $thumbnail = DB::table('medias')->where('id',$BestSallaerProduct->thumbnail_id)->first();
            $arr->thumbnail = $thumbnail;

            // Gallery
            $gallerys_ids = explode(',',$BestSallaerProduct->gallery_ids);
            $photos = array();
            foreach($gallerys_ids as $gallery_id){
                $photo = DB::table('medias')->where('id',$gallery_id)->first();
                if($photo != null) : array_push($photos,$photo); endif;
            }
            $arr->photos = (object)$photos;

            // Categorys
            $Categorys_ids = explode(',',$BestSallaerProduct->categorys_ids);
            $categorys = [];
            foreach($Categorys_ids as $Category_id){
                $category = DB::table('categorys')->where('id',$Category_id)->where('type','category')->first();
                if($category != null){
                array_push($categorys,$category);
                }
            }
            $arr->categorys = (object)$categorys;

            // reviews
            $reviews = DB::table('reviews')->where('product_id',$BestSallaerProduct->id)->get();
            $reviewStarsCount = 0;
            $reviewStarsAverage = 0.00;
            foreach($reviews as $review){
                $reviewStars = $review->stars;
                $reviewStarsCount += $reviewStars;
            }
            @$reviewStarsAverage = ($reviewStarsCount>0)?$reviewStarsCount/count($reviews):0;
            $arr->stars = $reviewStarsAverage;

            // push
            array_push($BestSallaerProductsData,$arr);
        }
        return $BestSallaerProductsData;
    }

    public function getLast3Posts(){
        $Posts =  DB::table('posts')->where('state', 'published')->take(3)->get();
        $PostsDataArray = [];

        foreach($Posts as $Post){
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
        return $PostsDataArray;
    }

    public function getCards(){
        $Cards = DB::table('cards')->get();
        $CardsArray= [];
        foreach($Cards as $Card){
            $CardArray = (object)[];
            // set categorys
            $CardArray->Card = $Card;
            // set thumbnail
            $thumbnail = DB::table('medias')->where('id',$Card->thumbnail)->first();
            $CardArray->thumbnail = $thumbnail;

            array_push($CardsArray,$CardArray);
        }
        return $CardsArray;
    }

    public function return404(){
        return view('404');
    }
}
