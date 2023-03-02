<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class checkoutController extends Controller
{
    //
    public function getForm(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                'product_id' => 'required',
                'product_qte' => 'required',
                // 'termes_check' => 'required',
            ],[
                'product_id.required' => 'Aucun produit sélectionné',
                'product_qte.required' => 'la quantité doit être d\'au moins 1 ou plus',
                // 'termes_check.required' => 'Veuillez cocher le bouton des termes et conditions',
            ]);
            $note = $request->note;
            $productids = (object)$request->product_id;
            $Qte = $request->product_qte;
            $i = 0;
            $products = [];
            foreach($productids as $productId){
                $product = [];
                $product['id'] = $productId;
                $product['qte'] = $Qte[$i];
                array_push($products,$product);
                $i++;
            }
            $totalCartPrice = $this->gettotalCartPrice($products);
            $totalTax = $this->gettotalTax($products);
            $products = json_encode($products);
            $Citys = DB::table('citys')->get();
            $array = array('totalCart' => $totalCartPrice,'totalTax'=> $totalTax,'Citys' =>$Citys,'products' => $products,'note' => $note);
            return view('Checkout',$array);
        }
    }
    public function addOrder(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                'first_name' => 'required',
                'phone' => 'required',
                'city' => 'required',
                // 'termes_check' => 'required'
            ],[
                'first_name.required' => 'Le prénom complet est obligatoire',
                'first_name.required' => 'La ville est obligatoire',
                'phone.required' => 'Le numéro de téléphone est obligatoire',
                // 'termes_check.required' => 'Veuillez cocher le bouton des termes et conditions',
            ]);
            $products = json_decode($request->products);

            $totalCartPrice = $request->totalCart;
            $totalTax = $request->totalTax;
            $note = $request->note;

            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $phone = $request->phone;
            $cityId = $request->city;
            $city = $this->getCity($cityId);
            $adress = $request->adress;
            $shippingcost = $city->shipping_cost;
            $orderCode = 'ST-'.rand(1000,9999);
            $totalOrder = $totalCartPrice+$shippingcost+$totalTax;
            $cartsIds = '';
            foreach($products as $product){
                $thisProduct = $this->getProdcut($product->id);
                $id = $thisProduct->id;
                $price = floatval($thisProduct->price);
                $qte = floatval($product->qte);
                $totalPrice = $price*$qte;
                $cartsId = $this->addTocart($thisProduct->id,$thisProduct->price,$qte,$totalPrice);
                $cartsIds = $cartsIds.','.$cartsId;

            }
            $cartsIds = trim($cartsIds,',');

            if(DB::insert('insert into orders (first_name,last_name,phone,city,adress,total_cart,shipping_cost,tax_cost,total_order,code,carts_ids,note,created_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?)', [$first_name,$last_name,$phone,$cityId,$adress,$totalCartPrice,$shippingcost,$totalTax,$totalOrder,$orderCode,$cartsIds,$note,now()])){
                $array = array('orderCode' => $orderCode);
                return view("order-confirmed",$array);
            }else{
                $array = array('error'=> 'Impossible d\'envoyer un message!');
                return view("Checkout",$array);
            }
        }
    }
    private function getTotalCartPrice($products){
        $cartPrice = 0;
        foreach($products as $product){
            $id = $product['id'];
            $qte = intval($product['qte']);
            $price = DB::table('products')->where('state','1')->where('id',$id)->first();
            $price = floatval($price->price);
            $cartPrice += $price*$qte;
        }
        return $cartPrice;
    }

    private function getTotalTax($products){
        $totalTax = 0;
        foreach($products as $product){
            $id = $product['id'];
            $qte = intval($product['qte']);
            $tax = DB::table('products')->where('state','1')->where('id',$id)->first();
            $tax = floatval($tax->tax);
            $totalTax += $tax*$qte;
        }
        return $totalTax;
    }
    private function getProdcut($id){
        $product = DB::table('products')->where('state','1')->where('id',$id)->first();
        return $product;
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

    public function sendToPanier(){
        return redirect('panier')->with('status', 'Impossible de traiter votre demande, veuillez vérifier à nouveau vos données soumises et réessayer');
    }
}
