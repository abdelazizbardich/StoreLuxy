<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use View;
use Illuminate\Support\Facades\Schema;
use DB;
use App\Models\Media;
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
        $this->Options->SiteOptions = (Schema::hasTable('options'))?$this->getSiteOptions():"";
        if(isset($this->Options->SiteOptions->instagram_photos)){
            $this->Options->SiteOptions->instagram_photos = $this->getIntagramPhotos($this->Options->SiteOptions->instagram_photos);
        }
        // Cart
        $this->Options->CartProducts = (Schema::hasTable('products'))?$this->getCartProducts():"";
        // Order Notice
        $this->Options->OrderNotice = (Schema::hasTable('ordernotice'))?$this->getOrderNoticeState():"";
        // Chat Message
        $this->Options->ChatMessage = (Schema::hasTable('chatmessage'))?$this->getChatMessageState():"";
        // carte Count
        $this->Options->CartCount = (Schema::hasTable('ordernotice'))?$this->getCartCount():"";
        // Categorys
            $this->Options->Categorys = (Schema::hasTable('categorys'))?$this->getCategorys():"";
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
            if($CategoryArray)
            array_push($CategorysArray,$CategoryArray);
        }
        //print_r($CategorysArray);
        return $CategorysArray;
    }

    private function getIntagramPhotos($photos){
        $photos = explode(',',$photos);
        $data = [];
        foreach ($photos as $photo) {
            array_push($data,Media::where('id',$photo)->first());
        }
        return $data;
    }

}
