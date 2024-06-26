<?php
namespace App\Traits;

use App\Models\Room;
use Illuminate\Support\Facades\Http;

trait Ipaymu {
    public $va;
    public $apiKey;
    private $orders_id;

    public function setOrdersIdInTrait($orders_id) {
        $this->orders_id = $orders_id;
    }

    public function __construct()
    {
        $this->va = config('ipaymu.va');
        $this->apiKey = config('ipaymu.api_key');
    }

    public function signature($body, $method)
    {
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $this->va . ':' . $requestBody . ':' . $this->apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $this->apiKey);

        return $signature;
    }


    public function redirect_payment($final_price)
    {
        $arr_cart_room_id = array();
        $i=0;
        foreach(session()->get('cart_room_id') as $value) {
            $arr_cart_room_id[$i] = $value;
            $i++;
        }

        $arr_cart_checkin_date = array();
        $i=0;
        foreach(session()->get('cart_checkin_date') as $value) {
            $arr_cart_checkin_date[$i] = $value;
            $i++;
        }

        $arr_cart_checkout_date = array();
        $i=0;
        foreach(session()->get('cart_checkout_date') as $value) {
            $arr_cart_checkout_date[$i] = $value;
            $i++;
        }

        $arr_cart_adult = array();
        $i=0;
        foreach(session()->get('cart_adult') as $value) {
            $arr_cart_adult[$i] = $value;
            $i++;
        }

        $arr_cart_children = array();
        $i=0;
        foreach(session()->get('cart_children') as $value) {
            $arr_cart_children[$i] = $value;
            $i++;
        }

        for($i=0;$i<count($arr_cart_room_id);$i++)
        {
            $r_info = Room::where('id',$arr_cart_room_id[$i])->first();

            $va           = '0000002142719548';
            $url          = 'https://sandbox.ipaymu.com/api/v2/payment';
            $method       = 'POST';
            $timestamp    = Date('YmdHis');

            $body['product'][]      = $r_info->name;
            $body['qty'][]          = 1;
            $body['price'][]        = $final_price;
            $body['description'][]  = 'Pembayaran Pemesananan Kamar Hotel Citra Megah';
            $body['referenceId']    = 'ID'.rand(1111, 9999);
            $body['returnUrl']      = route('callback.return');
            $body['notifyUrl']      = 'https://704e-149-108-13-62.ngrok-free.app/notify';
            $body['cancelUrl']      = route('callback.cancel');
            $body['paymentChannel']  = 'qris';
            $body['expired']        = 24;


            $signature = $this->signature($body, $method);

            $headers = array(
                'Content-Type' => 'application/json',
                'signature' => $signature,
                'va' => $va,
                'timestamp' => $timestamp
            );

            $data_request = Http::withHeaders(
                $headers
            )->post($url, $body);

            $responser = $data_request->object();

            return $responser;
        }
    }

    protected function balance()
    {
        $va           = $this->va;
        $url          = 'https://sandbox.ipaymu.com/api/v2/balance';
        $method       = 'POST';
        $timestamp    = Date('YmdHis');


        $body['account']    = $va;
        $signature = $this->signature($body, $method);


        $headers = array(
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp
        );

        $data_request = Http::withHeaders(
            $headers
        )->post($url, [
            'account' => $va
        ]);

        $responser = $data_request->object();
        return $responser;
    }
}
