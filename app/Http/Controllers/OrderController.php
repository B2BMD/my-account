<?php

namespace App\Http\Controllers;

use App\Helpers\CurlRequest;
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

    public function getUserOrders()
    {
        $user = Auth::User();
        $email = $user->email;

        return $this->getOrdersByEmail($email);
    }

    public function getOrdersByEmail($email)
    {
        // @TODO: remove this and next 3 lines, testing@gmail.com hasn't any order on customer e-commerce site
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
                    $item->product_short_description = empty($productDetail->short_description) ? null : $productDetail->short_description;
                }
            }
        }

        return $orderDetails;
    }

    public function getOrdersByEmailAndStatus($email = null, $status = null)
    {
        if (is_null($email) || is_null($status)) {
            return [];
        }
        // @TODO: remove this and next 3 lines, testing@gmail.com hasn't any order on customer e-commerce site
        if ('local' == env('APP_ENV')) {
            $email = 'kdsupportservices@charter.net';
        }

        $customer = $this->woocommerce->get('customers?email=' . $email . '&status=' . $status);

        if (empty($customer[0]) || empty($customer[0]->id)) {
            return false;
        }
        $orderDetails = $this->woocommerce->get('orders?customer=' . $customer[0]->id);

        if (!empty($orderDetails) && (count($orderDetails) > 0)) {
            foreach ($orderDetails as $order) {
                foreach ($order->line_items as $item) {
                    $productDetail = $this->woocommerce->get('products/' . $item->product_id);
                    $item->image_url = empty($productDetail->images[0]) || empty($productDetail->images[0]->src) ? null : $productDetail->images[0]->src;
                    $item->product_short_description = empty($productDetail->short_description) ? null : $productDetail->short_description;
                }
            }
        }

        return $orderDetails;
    }

    public function getOrderById($orderId)
    {
        $orderDetails = $this->woocommerce->get('orders/' . $orderId);

        if (!empty($orderDetails) && is_object($orderDetails)) {
            foreach ($orderDetails->line_items as $item) {
                $productDetail = $this->woocommerce->get('products/' . $item->product_id);
                $item->image_url = empty($productDetail->images[0]) || empty($productDetail->images[0]->src) ? null : $productDetail->images[0]->src;
                $item->product_short_description = empty($productDetail->short_description) ? null : $productDetail->short_description;
                $item->name = empty($productDetail->name) ? null : $productDetail->name;
                $item->total = empty($productDetail->total) ? null : $productDetail->total;
                $item->quantity = empty($productDetail->quantity) ? null : $productDetail->quantity;
            }

            // @TODO: delete next line, $orderDetails->case_number should be provide  from woocommerce,
            // or should be an endpoint on Platform API to retrieve case details passing order_id as param
            $orderDetails->case_number = '11181908590195315';

            if (!empty($orderDetails->case_number)) {
                // Dumb data for a while
                $curlData = json_decode(file_get_contents(env('DOWNLOAD_CONSULTANT') . '?type=get_patient_info&email=testing@gmail.com'), true);

                // This is what it should be doing
                // $curlData = CurlRequest::sendPostData(env('API_URL') . '?fn=get_case_details', ['casenum' => $orderDetails->case_number]);
                // $curlData = CurlRequest::sendPostData(env('API_URL') . '?fn=get_case_details', ['orderid' => $orderDetails->number]);
                $rand = rand(0, 2);

                if (!empty($curlData[$rand]['shipment_number'])) {
                    $tracking_history = $this->track_package($curlData[$rand]['shipment_number'], $curlData[$rand]['case_number']);
                }
            }
            // @TODO: delete next lines, $tracking_history depends on order's tracking number, no fake data should be available
            // $tracking_history = $this->track_package('9400111202530462818373', '11181908590195321');
            // $tracking_history = $this->track_package('9400111202530462817932', '11181908590195346');
            // $tracking_history = $this->track_package('9400111202530462817543', '11181908590195345');
            // $tracking_history = $this->track_package('9400111202530462816393', '11181908590195346');
            // $tracking_history = $this->track_package('9400108205497628225543', '11181908590195348');
            // $tracking_history = $this->track_package('9405503699300023237406', '11181908590195348');
            $tracking_history = $this->track_package('284034878315', '11181908590195315');
            // $tracking_history = $this->track_package(null, null);

            if (!empty($tracking_history)) {
                $orderDetails->tracking = $tracking_history;
            }
        }

        return [$orderDetails];
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
        $user = Auth::User();
        $email = $user->email;

        if (null == $slug) {
            return $this->getOrdersByEmail($email);
        }
        $orders = $this->getOrdersByEmailAndStatus($email, $slug);

        if ('processing' == $slug) {
            return view('orders.pending_orders', ['pendingOrders' => $orders, 'completedOrders' => []]);
        }

        if ('completed' == $slug) {
            return view('orders.pending_orders', ['pendingOrders' => [], 'completedOrders' => $orders]);
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
        $orderResponse = $this->getOrderById($orderId);

        return view('orders.orders_1', ['orderDetail' => (!empty($orderResponse[0]) && is_object($orderResponse[0])) ? $orderResponse[0] : null]);
    }

    public function track_package($shipment_tracking_number = null, $case_number = null)
    {
        return app('App\Http\Controllers\TrackingController')->history($shipment_tracking_number, $case_number);
    }

    public function trackOrder($orderId)
    {
        $shipStation = $this->app['LaravelShipStation\ShipStation'];
        $orderTrackingDetails = $shipStation->shipments->get([], $endpoint = $orderId);
        dd($orderTrackingDetails); // returns integer
    }
}
