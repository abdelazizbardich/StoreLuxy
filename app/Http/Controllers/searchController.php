<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class searchController extends Controller
{
    //
    public function search(Request $request){
        # code...
        $this->validate($request,['keyword' => 'required'],['keyword.required' => 'Le mot de recherche est obligatoire']);
        $Products = DB::table('products')->where('state','1')->where('name','like','%'.$request->keyword.'%')->orWhere('tags','like','%'.$request->keyword.'%')->paginate(12);
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
                if($category)
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
            @$reviewStarsAverage = ($reviewStarsCount>0)?$reviewStarsCount/count($reviews):0;
            $Products[$i]->stars = $reviewStarsAverage;
            $i++;
        }
        $array = array('Result' => $Products,'keyword' => $request->keyword);
        return view('search',$array);
    }
}
