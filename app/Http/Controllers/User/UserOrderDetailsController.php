<?php

namespace App\Http\Controllers\User;

use App\Models\OrderDetail;
use App\Models\Setting;
use Illuminate\Http\Request;

class UserOrderDetailsController {

  public function viewInvoice()
  {
    $settings = Setting::first();

    return view('user.invoice', compact('settings'));
  }


}
