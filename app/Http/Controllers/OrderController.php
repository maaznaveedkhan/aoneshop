<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class OrderController extends Controller
{
    public function orders(){
        $orders = Order::all();
        return view('admin.orders',compact('orders'));
    }

    public function placeOrder(Request $request)
    {

         $total = 0;
         $address = '';
         if(session('address')){
            $address = session()->get('address');
         }else{
            $address = $request->address;
         }
         $delivery_charges = 0;
        if(session('cart') && count(session('cart')) != 0 ){
            foreach (session('cart') as $id => $details){
                $total += $details['price'] * $details['quantity'];
                $delivery_charges += $details['delivery_charges'];

            }
        }
        // return  session()->get('cart');
        $user_id = Auth::user()->id;
        $order_number = random_int(100000, 999999);
        $order = new Order();
        // $order->email=$request->email;
        $order->phone_number = $request->phone_number ;
        $order->first_name = $request->name ;
        $order->city = $request->city ;
        $order->address = $address ;
        $order->post_code = $request->post_code;
        $order->notes = $request->notes ;
        $order->order_number = $order_number ;
        $order->user_id = $user_id;
        $order->grand_total = $total + $delivery_charges;
        $order->item_count = count( session()->get('cart'));
        $order->save();



        if(session('cart') && count(session('cart')) != 0 ){
            foreach (session('cart') as $id => $details){
                $total += $details['price'] * $details['quantity'];

                $order_item = new OrderItem();
                $order_item->order_id = $order->id ;
                $order_item->product_id =$id ;
                $order_item->quantity =$details['quantity'] ;
                $order_item->price =$details['price'] ;
                $order_item->save();
            }
        }

        $provider = new PaypalClient();

        $token = $provider->getAccessToken();
        $data = json_decode('{
            "intent": "CAPTURE",
            "purchase_units": [
            {
                "amount": {
                "currency_code": "USD",
                "value": "'. $order->grand_total.'"
                }
            }
            ]
        }', true);

     $order = $provider->createOrder($data);
    // dd($order);
    return redirect($order['links'][1]['href']);

        return 'wait';
        Session::forget('cart');



        return redirect('/')->with('success', 'your order has been received we will contact you soon!');
    }
}
