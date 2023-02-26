<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cookie;
class ajaxController extends Controller
{
    //
    public function addTocart($id)
    {
        // get product
        $Product = DB::table('products')->where('state','1')->where('id', $id)->first();
        $arr = array();
        $arr['name'] = $Product->name;
        $arr['price'] = $Product->price;
        $thumbnail = DB::table('medias')->where('id', $Product->thumbnail_id)->first();
        $arr['thumbnail'] = $thumbnail;
        $arr['id'] = $Product->id;

        $cartArray = Cookie::get('cart');
        $cartArray = (array)json_decode($cartArray);
        if(in_array($arr['id'], $cartArray)){ return '0'; }
        array_push($cartArray,$arr['id']);

        if(count($cartArray) == 0){
            Cookie::queue('cart', json_encode($cartArray), 43800);
        }else{
            Cookie::queue(Cookie::forget('cart'));
            Cookie::queue('cart', json_encode($cartArray), 43800);
        }
        return json_encode($arr);
        
    }
    public function removeFromcart($id)
    {
        $cartArray = Cookie::get('cart');
        $cartArray = (array)json_decode($cartArray);

        $cartArray = array_diff( $cartArray, [$id] );
    
        Cookie::queue(Cookie::forget('cart'));
        Cookie::queue('cart', json_encode($cartArray), 43800);

        return 1;

    }
    
    public function getRandomeProduct()
    {
        $Products = DB::table('products')->where('state','1')->get();
        foreach($Products as $Product){
            $Product->thumbnail = (DB::table('medias')->where('id',$Product->thumbnail_id)->first())->file;
        }
        $Products = json_decode(json_encode($Products));
        $RandomeIndex = array_rand($Products);
        $Products = (object)$Products;
        return json_encode($Products->$RandomeIndex);
    }

    public function desableOrderNotice(){
        Cookie::queue(Cookie::forget('ordernotice'));
        Cookie::queue('ordernotice', false, 4320);

    }

    public function desableChatMessage(){
        Cookie::queue(Cookie::forget('chatmessage'));
        Cookie::queue('chatmessage', false, 43800);
    }

    public function newsletterRegister(Request $request){
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){return 0;} 
        $email = $request->email;
        if(DB::insert('insert into newsletters (email) values (?)', [$email])){
            return 1;
        }else{
            return -1;
        }
    }

    public function newShare($id){
        $id = intval($id);
        $Post =  DB::table('posts')->where('id',$id)->first();
        $shares = intval($Post->shares);
        $shares = $shares+1;
        DB::update('update posts set shares = '.$shares.' where id = ?', [$id]);
    }
    
}
