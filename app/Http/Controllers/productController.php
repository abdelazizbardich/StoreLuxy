<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
 //
 public function getSingleProduct($name){

  $Product = DB::table('products')->where('state','1')->where('slug_name', $name)->first();
  if($Product != null){
   // Thumbnail
   $ThisPthumbnail = DB::table('medias')->where('id', $Product->thumbnail_id)->first();
   // gallery
   $gallerys_ids = explode(',',$Product->gallery_ids);
   $thisPphotos = array();
   foreach($gallerys_ids as $gallery_id){
     $thisPphoto = DB::table('medias')->where('id',$gallery_id)->first();
     if($thisPphoto != null) : array_push($thisPphotos,$thisPphoto); endif;
   }
   // Categorys
   $Categorys_ids = explode(',',$Product->categorys_ids);
   $PCategorys = [];
   foreach($Categorys_ids as $Categorys_id){
     $PCategory = DB::table('categorys')->where('id',$Categorys_id)->first();
     if($PCategory)
     array_push($PCategorys,$PCategory);
   }

   // reviews
   $reviews = DB::table('reviews')->where('product_id',$Product->id)->get();
   $reviewsData = [];
   foreach($reviews as $review){
     $reviewData = (object)[];
     $reviewData->data = $review;
     $reviewPhotosIds = explode(',',$review->gallery_ids);
     if($review->gallery_ids != null){
        $photos = [];
        foreach($reviewPhotosIds as $reviewPhotoId){
             $reviewPhoto = DB::table('medias')->where('id', $reviewPhotoId)->first();
             array_push($photos,$reviewPhoto);
        }
        $reviewData->photos = $photos;
     }

     array_push($reviewsData,$reviewData);

   }

   // Reviews stars average
   $reviewStarsCount = 0;
   $reviewStarsAverage = 0.00;
   foreach($reviews as $review){
     $reviewStars = $review->stars;
     $reviewStarsCount += $reviewStars;
   }
   if(count($reviews) != 0){@$reviewStarsAverage = ($reviewStarsCount)?$reviewStarsCount/count($reviews):0;}else{$reviewStarsAverage = 0;}
   // Reviews stars average By type
   $reviewStarsCountArr = (object)[];
   $reviewStarsCountArrStar1 = 0;
   $reviewStarsCountArrStar2 = 0;
   $reviewStarsCountArrStar3 = 0;
   $reviewStarsCountArrStar4 = 0;
   $reviewStarsCountArrStar5 = 0;
   $reviewStarsCountArr->star1 = 0;
   $reviewStarsCountArr->star2 = 0;
   $reviewStarsCountArr->star3 = 0;
   $reviewStarsCountArr->star4 = 0;
   $reviewStarsCountArr->star5 = 0;
   $count1 = 0;$count2 = 0;$count3 = 0;$count4 = 0;$count5 = 0;
   foreach($reviews as $review){
     if($review->stars == 1){$count1++;}
     if($review->stars == 2){$count2++;}
     if($review->stars == 3){$count3++;}
     if($review->stars == 4){$count4++;}
     if($review->stars == 5){$count5++;}
   }

   if(count($reviews) != 0){@$reviewStarsCountArr->star1 = (($count1)?$count1/count($reviews):0)*100;}else{$reviewStarsCountArr->star1 = 0;}
   if(count($reviews) != 0){@$reviewStarsCountArr->star2 = (($count2)?$count2/count($reviews):0)*100;}else{$reviewStarsCountArr->star2 = 0;}
   if(count($reviews) != 0){@$reviewStarsCountArr->star3 = (($count3)?$count3/count($reviews):0)*100;}else{$reviewStarsCountArr->star3 = 0;}
   if(count($reviews) != 0){@$reviewStarsCountArr->star4 = (($count4)?$count4/count($reviews):0)*100;}else{$reviewStarsCountArr->star4 = 0;}
   if(count($reviews) != 0){@$reviewStarsCountArr->star5 = (($count5)?$count5/count($reviews):0)*100;}else{$reviewStarsCountArr->star5 = 0;}




   // get sponsored
   $SponsoredProducts = DB::table('products')->where('state','1')->where('sponsored', 1)->get();
   $SponsoredProductsdata = [];
   foreach($SponsoredProducts as $SponsoredProduct){
     $arr = (object)array();
     $thumbnail = DB::table('medias')->where('id', $SponsoredProduct->thumbnail_id)->first();
     // push thumbnail to product
     $arr->Product = $SponsoredProduct;
     $arr->Thumbnail = $thumbnail;
     array_push($SponsoredProductsdata,$arr);
   }
   // Get similar products
   $SimilarProductData = [];
   $SimilarProducts = DB::table('products')->where('state','1')->get();
   foreach($SimilarProducts as $SimilarProduct){
     if($Product->id == $SimilarProduct->id){continue;}
     $SimilarProductArray = explode(',',$SimilarProduct->categorys_ids);
     $thisProductCaregorys = explode(',',$Product->categorys_ids);
     $SimilarProductsCategorys = array_intersect($SimilarProductArray,$thisProductCaregorys);
     if($SimilarProductsCategorys != null){
        array_push($SimilarProductData,$SimilarProduct->id);
     }

   }
   $AllSimiProduct = [];
   foreach($SimilarProductData as $SimilarProductid){
     $SimiProductData = (object)[];
     $SimiProduct = DB::table('products')->where('state','1')->where('id', $SimilarProductid)->first();
     $SimiProductData->Product = $SimiProduct;
     // Stars
     $Simireviews = DB::table('reviews')->where('product_id',$SimiProduct->id)->get();
     $SimireviewStarsCount = 0;
     $SimireviewStarsAverage = 0.00;
     foreach($Simireviews as $Simireview){
        $SimireviewStars = $Simireview->stars;
        $SimireviewStarsCount += $SimireviewStars;
     }
     @$SimireviewStarsAverage = ($SimireviewStarsCount)?$SimireviewStarsCount/count($Simireviews):0;
     $SimiProductData->stars = $SimireviewStarsAverage;
     // htumbnial
     $Simithumbnail = DB::table('medias')->where('id', $SimiProduct->thumbnail_id)->first();
     $SimiProductData->thumbnail = $Simithumbnail;
     // Gallery
     $Simigallerys_ids = explode(',',$SimiProduct->gallery_ids);
     $Simiphotos = array();
     foreach($Simigallerys_ids as $Simigallery_id){
        $Simiphoto = DB::table('medias')->where('id',$Simigallery_id)->first();
        if($Simiphoto != null) : array_push($Simiphotos,$Simiphoto); endif;
     }
     $SimiProductData->gallery = $Simiphotos;
     // Categorys
     $SimiCategorys_ids = explode(',',$SimiProduct->categorys_ids);
     $SimiPCategorys = [];
     foreach($SimiCategorys_ids as $SimiCategorys_id){
        $SimiPCategory = DB::table('categorys')->where('id',$SimiCategorys_id)->first();
        if($SimiPCategory)
        array_push($SimiPCategorys,$SimiPCategory);
     }
     $SimiProductData->categorys = $SimiPCategorys;
     // push
     if($SimiProductData)
     array_push($AllSimiProduct,$SimiProductData);
   }
   // -------
   // update post view
   $Citys = DB::table('citys')->get();
   // -------
   // -------
   $array = array('Citys'=>$Citys, 'Product' => $Product, 'categorys' => $PCategorys,'Thumbnail' => $ThisPthumbnail, 'Photos' => $thisPphotos, 'reviews'=> $reviewsData, 'reviewsCount' => count($reviews) , 'globalStarsAvr' => $reviewStarsAverage, 'reviewStarsCountArr' => $reviewStarsCountArr, 'SponsoredProduct' => $SponsoredProductsdata, 'similarProducts' => $AllSimiProduct);
   return view('product',$array);
  }else{
   return view('404');
  }
 }

 public function addReview(Request $request){
  if($request->isMethod('POST')){
   $this->validate($request,[
     'name' => 'required|min:5',
     'comment' => 'required|min:10',
     'strCount' => 'required|min:1'
   ],
   [
     'name.required' => 'Le nom est requis',
     'name.min' => 'Le nom doit comporter plus d\'un caractère',
     'comment.required' => 'Le nom est requis',
     'comment.min' => 'Le commentaire doit comporter plus de 10 caractères',
     'strCount.required' => 'les étoiles sont obligatoires',
     'strCount.min' => 'les étoiles sont obligatoires'
   ]
   );
   $photosIds = '';
   if($request->photos){
     foreach($request->photos as $photo){
        $photoId = $this->uploadImageFile($photo);
        $photosIds = $photosIds.','.$photoId;
     }
     $photosIds = trim($photosIds,',');
   }else{$photos = '';}
   $data = [
     'stars' => $request->strCount,
     'username' => $request->name,
     'comment' => $request->comment,
     'product_id' => $request->id,
     'state' => '0',
     'gallery_ids' => $photosIds,
     'created_at' => now(),
   ];
   $review = DB::table('reviews')->insertGetId($data);
   if($review){
     return redirect()->back()->with('message', 'Votre avis a été ajouté avec succès, merci!');
   }
  }
 }
 private function uploadImageFile($file){
  $filePath = $file->store('uploads/img/reviews', 'public');
  $data = [
   'type' => 'image',
   'file' => $filePath,
   'alt_title' => 'review file '.now(),
   'name' => $file,
   'slug_name' => $file,
   'file_desc' => '',
   'created_at' => now()
  ];
  $fileId = DB::table('medias')->insertGetId($data);
  return $fileId;
 }

 public function getProfuctComparePage(){
  return view('product-compare');
 }
}
