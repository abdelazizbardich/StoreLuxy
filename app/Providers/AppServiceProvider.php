<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use View;
use Illuminate\Support\Facades\Schema;
use DB;
use Cookie;
use Crypt;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Using Closure based composers...
        // site options
        $this->Options = (object)[];
        if (Schema::hasTable('options'))
        $this->Options->SiteOptions = $this->getSiteOptions();
        // Cart
        if (Schema::hasTable('products'))
        $this->Options->CartProducts = $this->getCartProducts();
        // Order Notice
        if (Schema::hasTable('ordernotice'))
        $this->Options->OrderNotice = $this->getOrderNoticeState();
        // Chat Message
        if (Schema::hasTable('chatmessage'))
        $this->Options->ChatMessage = $this->getChatMessageState();
        // carte Count
        if (Schema::hasTable('ordernotice'))
        $this->Options->CartCount = $this->getCartCount();
        // Categorys
        if (Schema::hasTable('categorys'))
            $this->Options->Categorys = $this->getCategorys();
            // Sare data to all views
            View::composer('*', function ($view) {
                $view->with('options', $this->Options);
            });
            Schema::defaultStringLength(191);

    }


    public function getSiteOptions(){
        $Options = DB::table('options')->get();
        // dd($Options);
        $arr = array();
        foreach($Options as $key=>$Option){
            // dd($key);
            $arr[$Option->name] = $Option->value;
        }
        // dd($arr);
        $Options = (object)$arr;
        return $Options;
    }
    public function getCartProducts(){
        if (Cookie::get('cart') !== null){
            $carts = json_decode(Cookie::get('cart'));
            $data = [];
            if($carts != null)
            foreach(($carts) as $cart){
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
            return $data;
        }
    }
    public function getCartCount(){
        $carts = (array)json_decode(Cookie::get('cart'));
        return count($carts);
    }
    public function getOrderNoticeState(){
        if (Cookie::get('ordernotice') !== null && Cookie::get('ordernotice') !== true){
            $OrderNotice = json_decode(Crypt::decrypt(Cookie::get('ordernotice'), false));
        }else{
            Cookie::queue('ordernotice', true, 43800);
            $OrderNotice = Cookie::get('ordernotice');
        }
        return $OrderNotice;
    }

    public function getChatMessageState(){
        if (Cookie::get('chatmessage') !== null && Cookie::get('chatmessage') !== true){
            $ChatMessage = json_decode(Crypt::decrypt(Cookie::get('chatmessage'), false));
        }else{
            Cookie::queue('chatmessage', true, 43800);
            $ChatMessage = Cookie::get('chatmessage');
        }
        return true;
    }
    public function getCategorys(){

        $Categorys = DB::table('categorys')->where('type','category')->get();
        $CategorysArray= [];
        foreach($Categorys as $Category){
            $CategoryArray = (object)[];
            // set categorys
            $CategoryArray->category = $Category;
            // set categorys products
            $Products = DB::table('products')->where('state','1')->get();
            $ProductsArray = [];
            foreach($Products as $Product){
                $ProductCategorysIdArray = explode(',',$Product->categorys_ids);
                if(in_array($Category->id,$ProductCategorysIdArray)){
                    $ProductArray = (object)[];
                    $ProductArray->Product = $Product;
                    $Productthumbnail = DB::table('medias')->where('id', $Product->thumbnail_id)->first();
                    $ProductArray->thumbnail = $Productthumbnail;
                    $ProductArray = (object)$ProductArray;
                    array_push($ProductsArray,$ProductArray);
                }else{
                    continue;
                }
            }
            $CategoryArray->category->products = (object)$ProductsArray;
            // set sub categorys
            $SubCategorys = DB::table('categorys')->where('parent',$Category->id)->get();
            $CategoryArray->subCategorys = $SubCategorys;
            array_push($CategorysArray,$CategoryArray);
        }
        //print_r($CategorysArray);
        return $CategorysArray;
    }

}
