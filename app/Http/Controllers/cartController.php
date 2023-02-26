<?php

namespace App\Http\Controllers;
use Cookie;
use DB;
use Illuminate\Http\Request;

class cartController extends Controller
{
    //
    public function getCartProducts(){
        if (Cookie::get('cart') !== null){
            $carts = json_decode(Cookie::get('cart'));
            $data = [];
            foreach($carts as $cart){
                $arr = (object)array();
                // product
                $Product = DB::table('products')->where('state','1')->where('id', $cart)->first();
                // Thumbnail 
                $thumbnail = DB::table('medias')->where('id', $Product->thumbnail_id)->first();
                // push thumbnail to product
                $arr->Product = $Product;
                $arr->Thumbnail = $thumbnail;
                array_push($data,$arr);
            }
            $array = array('carProducts' => $data);
            return view('/cart',$array);
        }else{
            $array = array('carProducts' => null);
            return view('/cart',$array);
        }
    }
}
