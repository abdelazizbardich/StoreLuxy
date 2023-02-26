<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class confirmeOrderController extends Controller
{
    //
    public function addSingleOrder(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                'termes_check' => 'required',
                'first_name' => 'required|min:2',
                'phone' => 'required|min:2',
                'id' => 'required',
                'product_qte' => 'min:1',
            ],[
                'termes_check.required' => 'Veuillez cocher le bouton des termes et conditions',
                'first_name.required' => 'Le prénom complet est obligatoire',
                'first_name.min' => 'Le prénom complet doit contenir au moins 2 caractères',
                'phone.required' => 'Le numéro de téléphone est obligatoire',
                'phone.min' => 'Le numéro de téléphone doit contenir au moins 2 caractères',
                'id.required' => 'Aucun produit sélectionné',
                'product_qte.required' => 'la quantité doit être d\'au moins 1 ou plus',
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
            
            if(DB::insert('insert into orders (first_name,last_name,phone,city,adress,total_cart,shipping_cost,tax_cost,total_order,code,carts_ids,note,created_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?)', [$first_name,$last_name,$phone,$cityId,$adress,$totalCart,$shippingcost,$taxCost,$totalOrder,'ST-'.rand(1000,9999),$cartsId,'This is a direct order',now()])){
                $this->removeFromStock($id,$qte);
                return view("order-confirmed");
            }else{
                $array = array('error'=> 'Impossible d\'envoyer un message!');
                return view("direct-Checkout",$array);
            }
        }
    }

    private function getProduct($id){
        $product = DB::table('products')->where('state','1')->where('id',$id)->first();
        return $product;
    }
    private function removeFromStock($id,$count){
        $stockCount = DB::table('products')->where('id',$id)->first();
        $NewStockCount = intval($stockCount->stock_amount) - intval($count);
        echo ($NewStockCount);
        $product = DB::table('products')->where('id',$id)->update(['stock_amount' => $NewStockCount]);
        return $NewStockCount;
    }
    private function addTocart($id,$price,$qte,$totalPrice){
        $data = [
            'product_id' => $id,
            'price' => $price,
            'quantity' => $qte,
            'total_price' => $totalPrice,
            'created_at' => now()
        ];
        $Cart = DB::table('catrs')->insertGetId($data);
        return $Cart;
    }
    private function getCity($id){

        $city = DB::table('citys')->where('id',$id)->first();
        return $city;

    }

}