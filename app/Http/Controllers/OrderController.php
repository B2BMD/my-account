<?php

namespace App\Http\Controllers;

use Automattic\WooCommerce\Client;
use Illuminate\Support\Facades\Auth;
use App\Helpers\TrackingHelper;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public $woocommerce;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function getOrders()
    {
       
        $woocommerce = new Client(
            env('WOO_COMMERCE_APP_URL'),
            env('CONSUMER_KEY'),
            env('CONSUMER_SECRET'),
            [ 'wp_api' => true,
            'version' => 'wc/v3',
            'timeout' => 400]
           
        );
        $productImages=[];
        $productShortDescription=[];
        $orderDetails = $woocommerce->get('orders');
        $productDetails = $woocommerce->get('products');
        foreach($productDetails as $product){
            $productImages[$product->id]=$product->images[0]->src;
            $productShortDescription[$product->id]=$product->short_description;
        }
        foreach($orderDetails as $order){
            
            if(array_key_exists($order->line_items[0]->product_id,$productImages)){
               $order->image_url=$productImages[$order->line_items[0]->product_id];
            }
            if(array_key_exists($order->line_items[0]->product_id,$productShortDescription)){
                $order->product_short_description=$productShortDescription[$order->line_items[0]->product_id];
             }
          
        }
        return $orderDetails;
      
        
    }
    public function getUserOrders(){
        $user = Auth::User();
        $email = $user->email;
        $orderResponse=[];
        $orderDetails=$this->getOrders();
        foreach($orderDetails as $order){
            if($order->billing->email==$email){
                $orderResponse=$order;
                return $orderResponse;
            }
        }
    }
    public function orders()
    {
        $orderDetails=[];
        $orderDetails=$this->getUserOrders();
        $pendingOrders=[];
        $completedOrders=[];
        if(!empty($orderDetails)){
            foreach($orderDetails as $order){
                if($order->status=='processing'){
                  array_push($pendingOrders,$order);
                }elseif($order->status=='completed'){
                    array_push($completedOrders,$order);
                }
            }
        }else{
            $orderDetails=[];
        }
       
        return view('orders.orders',['pendingOrders'=>$pendingOrders,'completedOrders'=>$completedOrders]);
    }

    public function completed_orders()
    {
        return view('orders.completed_orders');
    }

    public function pending_orders($slug)
    {
        $orders=[];
        $pendingOrders=[];
        $completedOrders=[];
        $orders=$this->getOrders();
        foreach($orders as $ord){
            if($ord->status=='processing'){
                array_push($pendingOrders,$ord);
              }elseif($ord->status=='completed'){
                  array_push($completedOrders,$ord);
              }
        }
        if($slug=='processing'){
            return view('orders.pending_orders',['pendingOrders'=>$pendingOrders,'completedOrders'=>[]]);
        }else if($slug=='completed'){
            return view('orders.pending_orders',['pendingOrders'=>[],'completedOrders'=>$completedOrders]);
        }
        
    }
    
    public function getProducts(){

        $woocommerce = new Client(
            env('WOO_COMMERCE_APP_URL'),
            env('CONSUMER_KEY'),
            env('CONSUMER_SECRET'),
            [ 'wp_api' => true,
            'version' => 'wc/v3',
            'timeout' => 400]
           
        );

        $productDetails = $woocommerce->get('products');
        if ($productDetails) {
            return $productDetails;
        }
        return "No order found";

    }

    public function singleOrder(){
        return view('orders.orders_1');
    }
    public function viewOrderDetails($orderId){
        $orderResponse=[];
        $allOrderDetails=$this->getOrders();
        $allProducts=$this->getProducts();
        foreach($allProducts as $product){
            $productImages[$product->id]=$product->images[0]->src;
        }
        foreach($allOrderDetails as $order){
            if($order->id==$orderId){
               $orderResponse=$order;
               $searchOrder=$order->line_items;
               foreach($searchOrder as $ord){
                   if(array_key_exists($ord->product_id,$productImages)){
                       $ord->productImage=$productImages[$ord->product_id];
                   }
               }
               array_merge($searchOrder);
            }
        }
        // dump($orderResponse);
        // dump($searchOrder);die;
        return view('orders.orders_1',['orderDetail'=>$orderResponse,'productDetail'=>$searchOrder]);
    }

    // usps tracking api
    public function track_package(){
        $status = TrackingHelper::trackPackage();

        //dd($status);

        if(isset($status['TrackInfo']['Error'])){
            // printing message in case of error
            dd($status['TrackInfo']['Error']['Description']);
        }
        else{
            dd('Fail');
        }
    }
    public function trackOrder($orderId){
        $shipStation = $this->app['LaravelShipStation\ShipStation'];
        $orderTrackingDetails = $shipStation->shipments->get([],$endpoint= $orderId);
        dd($orderTrackingDetails); // returns integer

    }
}
