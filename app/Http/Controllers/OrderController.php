<?php

namespace App\Http\Controllers;

use App\Helpers\TrackingHelper;
use Automattic\WooCommerce\Client;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public $woocommerce;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->woocommerce = new Client(
            env('WOO_COMMERCE_APP_URL'),
            env('CONSUMER_KEY'),
            env('CONSUMER_SECRET'),
            ['wp_api' => true,
                'version' => 'wc/v3',
                'timeout' => 400, ]
        );
    }

    public function getOrdersByEmail($email)
    {
        $productImages = [];
        $productShortDescription = [];

        // testing@gmail.com hasn't any order on customer e-commerce site
        if ('local' == env('APP_ENV')) {
            $email = 'kdsupportservices@charter.net';
        }

        $customer = $this->woocommerce->get('customers?email=' . $email);

        if (empty($customer[0]) || empty($customer[0]->id)) {
            return false;
        }
        $orderDetails = $this->woocommerce->get('orders?customer=' . $customer[0]->id);

        if (!empty($orderDetails) && (count($orderDetails) > 0)) {
            foreach ($orderDetails as $order) {
                foreach ($order->line_items as $item) {
                    $productDetail = $this->woocommerce->get('products/' . $item->product_id);
                    $item->image_url = empty($productDetail->images[0]) || empty($productDetail->images[0]->src) ? null : $productDetail->images[0]->src;
                    $item->product_short_description = empty($productDetail->short_description) ? null : strip_tags($productDetail->short_description);
                }
            }
        }

        return $orderDetails;
    }

    public function getOrderById($orderId)
    {
        $productImages = [];
        $productShortDescription = [];

        $orderDetails = $this->woocommerce->get('orders/' . $orderId);

        if (!empty($orderDetails) && is_object($orderDetails)) {
            foreach ($orderDetails->line_items as $item) {
                $productDetail = $this->woocommerce->get('products/' . $item->product_id);
                $item->image_url = empty($productDetail->images[0]) || empty($productDetail->images[0]->src) ? null : $productDetail->images[0]->src;
                $item->product_short_description = empty($productDetail->short_description) ? null : strip_tags($productDetail->short_description);
            }
        }

        return [$orderDetails];
    }

    public function getUserOrders()
    {
        $user = Auth::User();
        $email = $user->email;

        return $this->getOrdersByEmail($email);
    }

    public function orders()
    {
        $orderDetails = [];
        $orderDetails = $this->getUserOrders();

        $pendingOrders = [];
        $completedOrders = [];

        if (!empty($orderDetails)) {
            foreach ($orderDetails as $order) {
                if ('processing' == $order->status) {
                    array_push($pendingOrders, $order);
                } elseif ('completed' == $order->status) {
                    array_push($completedOrders, $order);
                }
            }
        } else {
            $orderDetails = [];
        }

        return view('orders.orders', ['pendingOrders' => $pendingOrders, 'completedOrders' => $completedOrders]);
    }

    public function completed_orders()
    {
        return view('orders.completed_orders');
    }

    public function pending_orders($slug)
    {
        $orders = [];
        $pendingOrders = [];
        $completedOrders = [];
        $orders = $this->getOrders();

        foreach ($orders as $ord) {
            if ('processing' == $ord->status) {
                array_push($pendingOrders, $ord);
            } elseif ('completed' == $ord->status) {
                array_push($completedOrders, $ord);
            }
        }

        if ('processing' == $slug) {
            return view('orders.pending_orders', ['pendingOrders' => $pendingOrders, 'completedOrders' => []]);
        }

        if ('completed' == $slug) {
            return view('orders.pending_orders', ['pendingOrders' => [], 'completedOrders' => $completedOrders]);
        }
    }

    public function getProducts()
    {
        $woocommerce = new Client(
            env('WOO_COMMERCE_APP_URL'),
            env('CONSUMER_KEY'),
            env('CONSUMER_SECRET'),
            ['wp_api' => true,
                'version' => 'wc/v3',
                'timeout' => 400, ]
        );

        $productDetails = $this->woocommerce->get('products');

        if ($productDetails) {
            return $productDetails;
        }

        return 'No order found';
    }

    public function singleOrder()
    {
        return view('orders.orders_1');
    }

    public function viewOrderDetails($orderId)
    {
        $orderResponse = [];
        $allOrderDetails = $this->getOrderById($orderId);
        $allProducts = $this->getProducts();

        foreach ($allProducts as $product) {
            $productImages[$product->id] = $product->images[0]->src;
        }

        foreach ($allOrderDetails as $order) {
            if ($order->id == $orderId) {
                $orderResponse = $order;
                $searchOrder = $order->line_items;

                foreach ($searchOrder as $ord) {
                    if (array_key_exists($ord->product_id, $productImages)) {
                        $ord->productImage = $productImages[$ord->product_id];
                    }
                }
                array_merge($searchOrder);
            }
        }
        // dump($orderResponse);
        // dump($searchOrder);die;
        return view('orders.orders_1', ['orderDetail' => $orderResponse, 'productDetail' => $searchOrder]);
    }

    // usps tracking api
    public function track_package()
    {
        $status = TrackingHelper::trackPackage();

        //dd($status);

        if (isset($status['TrackInfo']['Error'])) {
            // printing message in case of error
            dd($status['TrackInfo']['Error']['Description']);
        } else {
            dd('Fail');
        }
    }

    public function trackOrder($orderId)
    {
        $shipStation = $this->app['LaravelShipStation\ShipStation'];
        $orderTrackingDetails = $shipStation->shipments->get([], $endpoint = $orderId);
        dd($orderTrackingDetails); // returns integer
    }
}
