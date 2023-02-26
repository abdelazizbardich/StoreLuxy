<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class directCheckoutController extends Controller
{
    //

    public function getorderData($id,$qte){
        # code...
        $Product = $this->getOrderdProduct($id);
        $Product['Product']->qte = $qte;
        $Product = (object)$Product;
        $Citys = DB::table('citys')->get();
        $array = array('Product' => $Product,'Citys'=>$Citys);
        return view('direct-Checkout',$array);
    }


    public function getOrderdProduct($id){
        $Product = DB::table('products')->where('state','1')->where('id', $id)->first();
        if($Product != null){
        // Thumbnail 
        $ThisPthumbnail = DB::table('medias')->where('id', $Product->thumbnail_id)->first();
        // -------
        // -------
        $array = array('Product' => $Product,'Thumbnail' => $ThisPthumbnail);
        return $array;
    }else{
        return 0; 
    }
    }
}
