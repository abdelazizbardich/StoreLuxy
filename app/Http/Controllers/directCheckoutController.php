<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use City;
use Product;
class directCheckoutController extends Controller
{
    //

    public function getorderData($id, $qte)
    {
        # code...
        $Product = $this->getOrderdProduct($id);
        $Product['Product']->qte = $qte;
        $Product = (object) $Product;
        $Citys = DB::table('citys')->get();
        $array = ['Product' => $Product, 'Citys' => $Citys];
        return view('direct-Checkout', $array);
    }

    public function getOrderdProduct($id)
    {
        $Product = DB::table('products')
            ->where('state', '1')
            ->where('id', $id)
            ->first();
        if ($Product != null) {
            // Thumbnail
            $ThisPthumbnail = DB::table('medias')
                ->where('id', $Product->thumbnail_id)
                ->first();
            // -------
            // -------
            $array = ['Product' => $Product, 'Thumbnail' => $ThisPthumbnail];
            return $array;
        } else {
            return 0;
        }
    }

    public function addOrderFast(Request $request)
    {
        $this->validate($request, [
            'product' => 'required|exists:products,id',
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required|exists:citys,id',
            'address' => 'required',
        ]);
        $orderCode = "FK-".random_int(1111111,9999999);
        $product = $this->getProdcut($request->product);
        $cartId = $this->addTocart($product->id, $product->price, $request->product_qte, $product->price * $request->product_qte);
        $city = DB::table('citys')->where('id',$request->city)->first();
        if (DB::insert("INSERT INTO orders (first_name, last_name, phone, city, adress, total_cart, shipping_cost, tax_cost, total_order, code, carts_ids, note, state, created_at, updated_at) VALUES('".$request->name."', '', '".$request->phone."', ".$request->city.", '".$request->address."', ".$product->price * $request->product_qte.", ".$city->shipping_cost.", 0, ".$product->price * $request->product_qte.", '".$orderCode."', '".$cartId."', '".$request->note."', 0, now(), null)")) {
            $array = ['orderCode' => $orderCode];
            return view('order-confirmed', $array);
        } else {
            $array = ['error' => 'Impossible d\'envoyer un message!'];
            return view('Checkout', $array);
        }
    }

    private function getTotalCartPrice($products)
    {
        $cartPrice = 0;
        foreach ($products as $product) {
            $id = $product['id'];
            $qte = intval($product['qte']);
            $price = DB::table('products')
                ->where('state', '1')
                ->where('id', $id)
                ->first();
            $price = floatval($price->price);
            $cartPrice += $price * $qte;
        }
        return $cartPrice;
    }

    private function getTotalTax($products)
    {
        $totalTax = 0;
        foreach ($products as $product) {
            $id = $product['id'];
            $qte = intval($product['qte']);
            $tax = DB::table('products')
                ->where('state', '1')
                ->where('id', $id)
                ->first();
            $tax = floatval($tax->tax);
            $totalTax += $tax * $qte;
        }
        return $totalTax;
    }
    private function getProdcut($id)
    {
        $product = DB::table('products')
            ->where('state', '1')
            ->where('id', $id)
            ->first();
        return $product;
    }
    private function addTocart($id, $price, $qte, $totalPrice)
    {
        $data = [
            'product_id' => $id,
            'price' => $price,
            'quantity' => $qte,
            'client_ip' => $_SERVER['REMOTE_ADDR'],
            'total_price' => $totalPrice,
            'created_at' => now(),
        ];
        $Cart = DB::table('catrs')->insertGetId($data);
        return $Cart;
    }
    private function getCity($id)
    {
        $city = DB::table('citys')
            ->where('id', $id)
            ->first();
        return $city;
    }

    public function sendToPanier()
    {
        return redirect('panier')->with(
            'status',
            'Impossible de traiter votre demande, veuillez vérifier à nouveau vos données soumises et réessayer'
        );
    }
}
