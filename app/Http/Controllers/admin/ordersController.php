<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ordersController extends Controller
{
    //
    public function show(){
        $orders = $this->getAllOrdersData();
        $array = array('orders' => $orders);
        return view('admin.orders.all',$array);
    }

    // get Json Order details
    public function getJsonOrderDetails($id){
        $order = DB::table('orders')->where('id',$id)->first();
        $orderCartsIds = explode(',',$order->carts_ids);
        $orderCarts = [];
        foreach($orderCartsIds as $cartId){
            $orderCartData = $this->getOrderCatrData($cartId);
            array_push($orderCarts,$orderCartData);
        }
        $order->carts = $orderCartData;
        $city = DB::table('citys')->where('id',$order->city)->first();
        $order->city = $city->name." ".$city->shipping_cost. "(Dh)";
        return json_encode($order);
    }

    // get All Orders Data
    private function getAllOrdersData(){
        $orders = DB::table('orders')->orderBy('id', 'DESC')->get();
        return $orders;
    }

    // get Order Carts data
    private function getOrderCatrData($id){
        $carts = DB::table('catrs')->where('id',$id)->get();
        foreach($carts as $cart){
            $product = $this->getCartProduct($cart->product_id);
            $cart->product = $product;
        }
        return $carts;
    }

    // get cart Product
    private function getCartProduct($id){
        $product = DB::table('products')->where('id',$id)->first();
        return $product;
    }

    // get Order
    public function getOrder($id){
        $order = DB::table('orders')->where('id',$id)->first();
        $orderCartsIds = explode(',',$order->carts_ids);
        $orderCarts = [];
        foreach($orderCartsIds as $cartId){
            $orderCartData = $this->getOrderCatrData($cartId);
            array_push($orderCarts,$orderCartData);
        }
        $order->carts = $orderCartData;
        $order->notes = $this->getOrderNotes($order->id);
        $city = DB::table('citys')->where('id',$order->city)->first();
        $order->city = $city->name." ".$city->shipping_cost. "(Dh)";
        $array = array('order' => $order);
        return view('admin.orders.edit',$array);
    }

    // Get Order Notes
    private function getOrderNotes($id){
        $notes = DB::table('track_orders')->where('order_id',$id)->orderBy('id','DESC')->get();
        return $notes;
    }

    // set Order Note as Done
    public function setNoteAsDone($id,$orderId){
        $note = DB::table('track_orders')->where('id',$id)->update(array('state'=>'done'));
        return $this->getOrder($orderId);
    }

    // set Order note as progress
    public function setNoteAsProgress($id,$orderId){
        $note = DB::table('track_orders')->where('id',$id)->update(array('state'=>'progress'));
        return $this->getOrder($orderId);
    }

    // delete order
    public function deleteNote($id,$orderId){
        $note = DB::table('track_orders')->delete($id);
        return $this->getOrder($orderId);
    }

    // Add New Note

    public function addNewNote(Request $request){
        $title = $request->title;
        $details = $request->details;
        if($request->state == 0){$state = 'progress';}elseif($request->state == 1){$state = 'done';}
        $orderId = $request->orderId;
        $now = now();
        DB::insert('insert into track_orders (order_id, title, details, state, created_at) values (?, ?, ?, ?, ?)', [$orderId,$title,$details,$state,$now]);
        return $this->getOrder($orderId);
    }

    // update Order State
    public function editOrderState($state,$orderId){
        if($state == 1){$state = 1;}elseif($state == 0){$state = 0;}else {$state = 0;}
        $order = DB::table('orders')->where('id',$orderId)->update(array('state'=>$state));
        return $this->getOrder($orderId);
    }

    // delete Order
    public function deleteOrder($id){
        $order = DB::table('orders')->delete($id);
        return $this->show();
    }

    // get city

}
