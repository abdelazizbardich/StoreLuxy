<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class trackOrderController extends Controller
{
    //

    public function show(){
        $array = array('orderDetails' => '');
        return view('order-tracking',$array);
    }
    public function getOrderDetails($orderCode,$phoneNumber){

    }
    public function getOrderStates(Request $request){
        $this->validate($request,[
            'code' => 'required|min:4',
            // 'phone' => 'required|digits:10',
        ],
        [
            'code.required' => 'Le code du commande est obligatoire',
            'code.min' => 'Le code du commande doit contenir au moins 4 caractères',

            // 'phone.required' => 'Le numéro de téléphone est obligatoire',
            // 'phone.digits' => 'Le numéro de téléphone doit être un numéro valide',
        ]);

        $order = DB::table('orders')->where('code',$request->code)->first();
        if($order != null){
            $ordersStates = DB::table('track_orders')->where('order_id',$order->id)->orderBy('id', 'DESC')->get();
            $orderDetails = (object)[];
            $orderDetails->ordersStates = $ordersStates;
            $orderDetails->code = $request->code;
            $orderDetails->phone = $request->phone;
            $orderDetails->errors = '';
            $array = array('orderDetails' => $orderDetails);
            return view('order-tracking',$array);
        }
        else {
            $orderDetails = (object)[];
            $orderDetails->errors = 'لم يتم العثور على طلب مرتبط بالكود المقدم';
            $array = array('orderDetails' => $orderDetails);
            return view('order-tracking',$array);
        }

    }
    public function getDetails($code){
        $order = DB::table('orders')->where('code',$code)->first();
            $ordersId = explode(',',$order->carts_ids);
            $orderDetails = (object)[];
            $orderDetail = [];
            foreach($ordersId as $id){
                $carts = DB::table('catrs')->where('id',$ordersId)->first();
                $Product = DB::table('products')->where('id',$carts->product_id)->first();
                // Thumbnail
                $thumbnail = DB::table('medias')->where('id', $Product->thumbnail_id)->first();
                $Product->qte = $carts->quantity;
                $Product->total_price = $carts->total_price;
                $Product->thumbnail = $thumbnail;
               array_push($orderDetail,$Product);
            }
        $city = DB::table('citys')->where("id",$order->city)->first();
        $orderDetails->products = $orderDetail;
        $orderDetails->details = $order;
        $orderDetails->details->city = $city->name;
        $array = array('orderDetails' => $orderDetails);
        return view('order-tracking',$array);
    }
}
