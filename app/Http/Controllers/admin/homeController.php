<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    //
    public function show(){
        $ordersCount = $this->getAllOrdersCount();
        $postsCount = $this->getPostsCount();
        $reviewsCount = $this->getReviewsCount();
        $productsCount = $this->getProductsCount();
        $newslettersCount = $this->getNewslettersCount();
        $usersCount = $this->getUsersCount();
        $monthlyEarning = $this->getMonthlyEarning();
        $array = $arrayName = array(
            'ordersCount' => $ordersCount,
            'postsCount' => $postsCount,
            'reviewsCount' => $reviewsCount,
            'productsCount' => $productsCount,
            'newslettersCount' => $newslettersCount,
            'usersCount' => $usersCount,
            'monthlyEarning' => $monthlyEarning,
        );
        return view('admin.index',$array);
    }
    /*
    /
    /
    /
    /
    /
    /
    /
    /
    */
    // get All Orders count
    public function getAllOrdersCount(){
        $ordersCount = DB::table('orders')->count();
        return $ordersCount;
    }
    // Get posts count
    public function getPostsCount(){
        $postsCount = DB::table('posts')->count();
        return $postsCount;
    }
    // Get Reviews Count
    public function getReviewsCount(){
        $reviewsCount = DB::table('reviews')->count();
        return $reviewsCount;
    }
    // get Products Count
    public function getProductsCount(){
        $productsCount = DB::table('products')->count();
        return $productsCount;
    }
    // Get Newsletter Count
    public function getNewslettersCount(){
        $newslettersCount = DB::table('newsletters')->count();
        return $newslettersCount;
    }
    // Get Users Count 
    public function getUsersCount(){
        $usersCount = DB::table('users')->count();
        return $usersCount;
    }
    // get this year earning by month
    public function getMonthlyEarning(){
        $orders = DB::table('orders')->get();
        $monthlyEarning = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'12' => 0);
        foreach($orders as $order){
            $orderDate = explode(' ',$order->created_at);
            $orderDate = explode('-',$orderDate[0]);
            if($orderDate[0] == date('Y')){
                if($orderDate[1] == '01'){ $monthlyEarning[1] += $order->total_order;}
                if($orderDate[1] == '02'){ $monthlyEarning[2] += $order->total_order;}
                if($orderDate[1] == '03'){ $monthlyEarning[3] += $order->total_order;}
                if($orderDate[1] == '04'){ $monthlyEarning[4] += $order->total_order;}
                if($orderDate[1] == '05'){ $monthlyEarning[5] += $order->total_order;}
                if($orderDate[1] == '06'){ $monthlyEarning[6] += $order->total_order;}
                if($orderDate[1] == '07'){ $monthlyEarning[7] += $order->total_order;}
                if($orderDate[1] == '08'){ $monthlyEarning[8] += $order->total_order;}
                if($orderDate[1] == '09'){ $monthlyEarning[9] += $order->total_order;}
                if($orderDate[1] == '10'){ $monthlyEarning[10] += $order->total_order;}
                if($orderDate[1] == '11'){ $monthlyEarning[11] += $order->total_order;}
                if($orderDate[1] == '12'){ $monthlyEarning[12] += $order->total_order;}
            }
        }
        return $monthlyEarning;
    }
}
