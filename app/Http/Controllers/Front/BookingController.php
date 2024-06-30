<?php

namespace App\Http\Controllers\Front;

use App\Filament\Pages\FonteeSetting;
use App\Http\Controllers\Controller;
use App\Mail\HelloMail;
use App\Models\BookedRoom;
use App\Models\ExtraServices;
use App\Models\NotificationFontee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use App\Models\Setting;
use App\Models\User;
use App\Traits\Fonnte;
use App\Traits\Ipaymu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class BookingController extends Controller
{
    use Ipaymu;

    use Fonnte;

    public function cart_submit(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'checkin_checkout' => 'required',
            'adult' => 'required'
        ]);

        $dates = explode(' - ',$request->checkin_checkout);
        $checkin_date = $dates[0];
        $checkout_date = $dates[1];

        $d1 = explode('/',$checkin_date);
        $d2 = explode('/',$checkout_date);
        $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
        $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
        $t1 = strtotime($d1_new);
        $t2 = strtotime($d2_new);

        $cnt = 1;
        while(1) {
            if($t1>=$t2) {
                break;
            }
            $single_date = date('d/m/Y',$t1);
            $total_already_booked_rooms = BookedRoom::where('booking_date',$single_date)->where('room_id',$request->room_id)->count();

            $arr = Room::where('id',$request->room_id)->first();
            $total_allowed_rooms = $arr->total_rooms;

            if($total_already_booked_rooms == $total_allowed_rooms) {
                $cnt = 0;
                break;
            }
            $t1 = strtotime('+1 day',$t1);
        }

        if($cnt == 0) {
            return redirect()->back()->with('error', 'Maximum number of this room is already booked');
        }

        session()->push('cart_room_id',$request->room_id);
        session()->push('cart_checkin_date',$checkin_date);
        session()->push('cart_checkout_date',$checkout_date);
        session()->push('cart_adult',$request->adult);
        session()->push('cart_children',$request->children);

        return redirect()->route('cart')->with('success', 'Room is added to the cart successfully.');
    }

    public function cart_view()
    {
        $services = ExtraServices::get();
        $settings = Setting::first();

        return view('front.cart', compact('services', 'settings'));
    }

    public function cart_delete($id)
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

        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');

        for($i=0;$i<count($arr_cart_room_id);$i++)
        {
            if($arr_cart_room_id[$i] == $id)
            {
                continue;
            }
            else
            {
                session()->push('cart_room_id',$arr_cart_room_id[$i]);
                session()->push('cart_checkin_date',$arr_cart_checkin_date[$i]);
                session()->push('cart_checkout_date',$arr_cart_checkout_date[$i]);
                session()->push('cart_adult',$arr_cart_adult[$i]);
                session()->push('cart_children',$arr_cart_children[$i]);
            }
        }

        return redirect()->back()->with('success', 'Cart item is deleted.');

    }

    public function checkout()
    {
        $settings = Setting::first();
        return view('front.booking', compact('settings'));
    }

    public function payment(Request $request)
    {
        $settings = Setting::first();

        if(!Auth::check()) {
            return redirect()->back()->with('error', 'You must have to login in order to checkout');
        }

        if(!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'There is no item in the cart');
        }

        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required|email',
        ]);

        session()->put('billing_name',$request->billing_name);
        session()->put('billing_email',$request->billing_email);
        session()->put('billing_phone',$request->billing_phone);
        session()->put('billing_country',$request->billing_country);
        session()->put('billing_address',$request->billing_address);
        session()->put('billing_notes',$request->billing_notes);

        return view('front.payment', compact('settings'));
    }

    public function pay_at_hotel(Request $request,$final_price)
{
    $order_no = time();

    $order = Order::create([
        'user_id' => Auth::user()->id,
        'order_no' => $order_no,
        'payment_method' => 'Pay At Hotel',
        'paid_amount' => $final_price,
        'booking_date' => date('d/m/Y'),
        'status' => 'SUCCESS',
    ]);

    $orders_id = $order->id;

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
        $d1 = explode('/',$arr_cart_checkin_date[$i]);
        $d2 = explode('/',$arr_cart_checkout_date[$i]);
        $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
        $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
        $t1 = strtotime($d1_new);
        $t2 = strtotime($d2_new);
        $diff = ($t2-$t1)/60/60/24;
        $sub = $r_info->price*$diff;

        $obj = new OrderDetail();
        $obj->order_id = $orders_id;
        $obj->room_id = $arr_cart_room_id[$i];
        $obj->room_name = $r_info->name;
        $obj->checkin_date = $arr_cart_checkin_date[$i];
        $obj->checkout_date = $arr_cart_checkout_date[$i];
        $obj->night = $diff;
        $obj->adult = $arr_cart_adult[$i];
        $obj->children = $arr_cart_children[$i];
        $obj->subtotal = $sub;
        $obj->save();

        while(1) {
            if($t1>=$t2) {
                break;
            }

            $obj = new BookedRoom();
            $obj->booking_date = date('d/m/Y',$t1);
            $obj->order_no = $order_no;
            $obj->room_id = $arr_cart_room_id[$i];
            $obj->save();

            $t1 = strtotime('+1 day',$t1);
        }
    }

    $customer_name = Auth::user()->name;
    $customer_phone = Auth::user()->phone;

    $messages = "Selamat kak $customer_name anda berhasil melakukan pemesanan!";

    try {
        $this->send_message($customer_phone, $messages);
    } catch (\Exception $e) {
        dd("Error sending message: " . $e->getMessage());
    }

    session()->forget('cart_room_id');
    session()->forget('cart_checkin_date');
    session()->forget('cart_checkout_date');
    session()->forget('cart_adult');
    session()->forget('cart_children');
    session()->forget('billing_name');
    session()->forget('billing_email');
    session()->forget('billing_phone');
    session()->forget('billing_country');
    session()->forget('billing_address');
    session()->forget('billing_notes');

    return redirect()->route('home')->with('success', 'Payment is successful');
}

    public $va;
    public $apiKey;
    public function __construct()
    {
        $this->va = config('ipaymu.va');
        $this->apiKey = config('ipaymu.api_key');
    }

    public function signature($body, $method)
    {
        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $this->va . ':' . $requestBody . ':' . $this->apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $this->apiKey);
        //End Generate Signature

        return $signature;
    }

    public function IpaymuSuccess(){


    }

    public function ipaymu($final_price)
    {
        $order_no = time();

        $payment = json_decode(json_encode($this->redirect_payment($final_price)), true);

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_no' => $order_no,
            'payment_method' => 'Ipaymu',
            'session_id' => $payment['Data']['SessionID'],
            'link' => $payment['Data']['Url'],
            'paid_amount' => $final_price,
            'booking_date' => date('d/m/Y'),
            'status' => 'PENDING',
        ]);

        // dd($payment);

        $orders_id = $order->id;

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
            $order_no = time();
            $r_info = Room::where('id',$arr_cart_room_id[$i])->first();
            $d1 = explode('/',$arr_cart_checkin_date[$i]);
            $d2 = explode('/',$arr_cart_checkout_date[$i]);
            $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
            $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
            $t1 = strtotime($d1_new);
            $t2 = strtotime($d2_new);
            $diff = ($t2-$t1)/60/60/24;
            $sub = $r_info->price*$diff;

            $obj = new OrderDetail();
            $obj->order_id = $orders_id;
            $obj->room_id = $arr_cart_room_id[$i];
            $obj->room_name = $r_info->name;
            $obj->checkin_date = $arr_cart_checkin_date[$i];
            $obj->checkout_date = $arr_cart_checkout_date[$i];
            $obj->night = $diff;
            $obj->adult = $arr_cart_adult[$i];
            $obj->children = $arr_cart_children[$i];
            $obj->subtotal = $sub;
            $obj->save();

            while(1) {
                if($t1>=$t2) {
                    break;
                }

                $obj = new BookedRoom();
                $obj->booking_date = date('d/m/Y',$t1);
                $obj->order_no = $order_no;
                $obj->room_id = $arr_cart_room_id[$i];
                $obj->save();

                $t1 = strtotime('+1 day',$t1);
            }
        }

        $subject = 'Pemesanan Kamar Hotel Dengan Ipaymu Berhasil';
        $message = '<html><body>';
        $message .= '<div style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px;">';
        $message .= '<div style="max-width: 600px; margin: 0 auto; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px;">';
        $message .= '<h1 style="color: #333; text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 20px;">Pemesanan Kamar Hotel Berhasil</h1>';
        $message .= '<p style="color: #666; text-align: center; margin-top: 30px;">Informasi pemesanan Anda sebagai berikut:</p>';
        $message .= '<ul style="list-style-type: none; padding: 0; text-align: center;">';
        $message .= '<li style="margin-bottom: 10px;"><strong>No Pesanan:</strong> '.$order_no.'</li>';
        $message .= '<li style="margin-bottom: 10px;"><strong>Metode Pembayaran:</strong> Ipaymu</li>';
        $message .= '<li style="margin-bottom: 10px;"><strong>Jumlah Bayar:</strong> Rp '.number_format($final_price, 2, ',', '.').'</li>';
        $message .= '<li style="margin-bottom: 10px;"><strong>Tanggal Pemesanan:</strong> '.date('d/m/Y').'</li>';
        $message .= '</ul>';

        $message .= '<div style="background-color: #f9f9f9; padding: 10px; margin-top: 30px; border-radius: 5px;">';
        for ($i = 0; $i < count($arr_cart_room_id); $i++) {
            $r_info = Room::where('id', $arr_cart_room_id[$i])->first();
            $message .= '<p><strong>Room Name:</strong> ' . $r_info->name . '</p>';
            $message .= '<p><strong>Price Per Night:</strong> Rp' . $r_info->price . '</p>';
            $message .= '<p><strong>Checkin Date:</strong> ' . $arr_cart_checkin_date[$i] . '</p>';
            $message .= '<p><strong>Checkout Date:</strong> ' . $arr_cart_checkout_date[$i] . '</p>';
            $message .= '<p><strong>Adult:</strong> ' . $arr_cart_adult[$i] . '</p>';
            $message .= '<p><strong>Children:</strong> ' . $arr_cart_children[$i] . '</p>';
        }
        $message .= '</div>';
        $message .= '</div>';
        $message .= '</div>';
        $message .= '</div>';
        $message .= '</body></html>';


        $customer_email = Auth::user()->email;

        Mail::to($customer_email)->send(new HelloMail($subject,$message));

        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');
        session()->forget('billing_name');
        session()->forget('billing_email');
        session()->forget('billing_phone');
        session()->forget('billing_country');
        session()->forget('billing_address');
        session()->forget('billing_notes');

        return redirect($order->link);
    }

    public function notify(Request $request)
    {
        $trx_id = $request->trx_id;
        $sid = $request->sid;
        $status = $request->status;

        $order = Order::where('session_id', $sid)->first();

        if ($status == 'berhasil') {
            $order->payment_date = now();
            $order->status = 'SUCCESS';
            $order->trx_id = $trx_id;
            $order->update();

            // $user = DB::table('nama_tabel')
            //     ->where('trx_id', $trx_id)
            //     ->value('user_id');

            // $subject = 'Pemesanan Kamar Hotel Dengan Ipaymu Berhasil Dibayar';
            // $message = '<html><body>';
            // $message .= '<div style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px;">';
            // $message .= '<div style="max-width: 600px; margin: 0 auto; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">';
            // $message .= '<h1 style="color: #333; text-align: center; padding: 20px 0;">Pemesanan Kamar Hotel Berhasil</h1>';
            // $message .= '<p style="color: #666; text-align: center;">Informasi pemesanan Anda sebagai berikut:</p>';
            // $message .= '<ul style="list-style-type: none; padding: 0; text-align: center;">';
            // $message .= '<li style="margin-bottom: 10px;"><strong>No Pesanan:</strong> '.$order_no.'</li>';
            // $message .= '<li style="margin-bottom: 10px;"><strong>Metode Pembayaran:</strong> Ipaymu</li>';
            // $message .= '<li style="margin-bottom: 10px;"><strong>Jumlah Bayar:</strong> Rp '.number_format($final_price, 2, ',', '.').'</li>';
            // $message .= '<li style="margin-bottom: 10px;"><strong>Tanggal Pemesanan:</strong> '.date('d/m/Y').'</li>';
            // $message .= '</ul>';
            // $message .= '</div>';
            // $message .= '</div>';
            // $message .= '</div>';
            // $message .= '</body></html>';

            // Mail::to($customer_email)->send(new HelloMail($subject, $message));
        } else {
            $order->status = $status;
            $order->update();
        }

        return response() -> json(['status' => 'ok']);
    }

    public function index()
    {
        $userId = Auth::id();
        $users = User::find($userId);
        $services = ExtraServices::get();

        $latestOrders = OrderDetail::where('orders_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        $roomPrice = null;

        if ($latestOrders) {
            $roomId = $latestOrders->room_id;
            $room = Room::find($roomId);
            if ($room) {
                $roomPrice = $room->price;
            }
        }

        $countries = [];
        $response = Http::get('https://restcountries.com/v3.1/all');
        if ($response->successful()) {
            $countriesData = $response->json();
            foreach ($countriesData as $country) {
                $countries[] = $country['name']['common'];
            }
        }

        return view('front.booking', compact('latestOrders', 'users', 'roomPrice', 'countries', 'services'));
    }

    public function prosesOrders(Request $request)
    {
        $checkinText = $request->input('checkinText');
        $checkoutText = $request->input('checkoutText');
        $nightCount = $request->input('nightCount');
        $hotelName = $request->input('hotelName');
        $roomId = $request->input('roomId');
        $roomNameSummary = $request->input('roomNameSummary');
        $childCount = $request->input('childCount');
        $adultCount = $request->input('adultCount');
        $totalRoomPrice = $request->input('totalRoomPrice');

        $userId = Auth::id();

        $timestamp = now()->format('YmdHis');
        $userIdPart = str_pad($userId, 4, '0', STR_PAD_LEFT); // Maksimum ID 4 digit
        $randomPart = mt_rand(100, 999); // Angka acak 3 digit
        $orderNumber = $timestamp . $userIdPart . $randomPart;

        $obj = new OrderDetail();
        $obj->cust_id = $userId;
        $obj->room_id = $roomId;
        $obj->room_name = $roomNameSummary;
        $obj->hotel_name = $hotelName;
        $obj->order_no = $orderNumber;
        $obj->checkin_date = $checkinText;
        $obj->checkout_date = $checkoutText;
        $obj->night = $nightCount;
        $obj->children = $childCount;
        $obj->adult = $adultCount;
        $obj->subtotal = $totalRoomPrice;
        $obj->save();

        return response()->json(['message' => 'Pemesanan berhasil dilakukan']);
    }

    public function detail_order()
    {
        return view('front.order_detail');
    }

    // public function handlePayment(Request $request)
    // {
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $paypalToken = $provider->getAccessToken();
    //     $response = $provider->createOrder([
    //         "intent" => "CAPTURE",
    //         "application_context" => [
    //             "return_url" => route('success.payment'),
    //             "cancel_url" => route('cancel.payment'),
    //         ],
    //         "purchase_units" => [
    //             0 => [
    //                 "amount" => [
    //                     "currency_code" => "IDR",
    //                     "value" => "100.000"
    //                 ]
    //             ]
    //         ]
    //     ]);
    //     if (isset($response['id']) && $response['id'] != null) {
    //         foreach ($response['links'] as $links) {
    //             if ($links['rel'] == 'approve') {
    //                 return redirect()->away($links['href']);
    //             }
    //         }
    //         return redirect()
    //             ->route('home')
    //             ->with('error', 'Something went wrong.');
    //     } else {
    //         return redirect()
    //             ->route('home')
    //             ->with('error', $response['message'] ?? 'Something went wrong.');
    //     }
    // }

    // public function paymentCancel()
    // {
    //     return redirect()
    //         ->route('create.payment')
    //         ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    // }

    // public function paymentSuccess(Request $request)
    // {
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->getAccessToken();
    //     $response = $provider->capturePaymentOrder($request['token']);
    //     if (isset($response['status']) && $response['status'] == 'COMPLETED') {
    //         return redirect()
    //             ->route('home')
    //             ->with('success', 'Transaction complete.');
    //     } else {
    //         return redirect()
    //             ->route('payment')
    //             ->with('error', $response['message'] ?? 'Something went wrong.');
    //     }
    // }
}
