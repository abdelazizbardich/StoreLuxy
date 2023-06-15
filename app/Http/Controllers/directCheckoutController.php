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

    public function addOrderFast(Request $request){
        $this->validate($request,[
            "product" => 'required|exists:products,id',
            "name" => 'required',
            "phone" => 'required',
            "city" => 'required|exists:citys,id',
            "address" => 'required'
        ]);
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $phone = $request->phone;
        $cityId = $request->city;
        $city = $this->getCity($cityId);
        $adress = $request->adress;
        $id = $request->id;
        $qte = $request->product_qte;
        $product = $this->getProduct($id);
        $totalCart = $qte*$product->price;
        $shippingcost = $city->shipping_cost;
        $taxCost = $product->tax;
        $totalOrder = $totalCart+$shippingcost+$taxCost;
        $cartsId = $this->addTocart($id,$product->price,$qte,$totalCart);


        if(DB::insert('insert into orders (first_name,last_name,phone,city,adress,total_cart,shipping_cost,tax_cost,total_order,code,carts_ids,note,created_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?)', [$first_name,$last_name,$phone,$cityId,$adress,$totalCart,$shippingcost,$taxCost,$totalOrder,'ST-'.rand(1000,9999),$cartsId,'طلب سريع',now()])){
            $this->removeFromStock($id,$qte);
            return view("order-confirmed");
        }else{
            $array = array('error'=> 'Impossible d\'envoyer un message!');
            return view("direct-Checkout",$array);
        }
    }
}
