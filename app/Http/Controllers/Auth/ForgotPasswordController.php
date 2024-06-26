<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgotPasswordForm()
      {
         return view('auth.forgot-password');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgotPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

          $token = Str::random(64);

          DB::table('password_reset_tokens')->insertOrIgnore([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);

          Mail::send('email.forgot-password', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Ubah Password');
          });

          return back()->with('message', 'Kami telah mengirim link ubah password, Silahkan cek email anda!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) {
         return view('auth.forgot-password-link', ['token' => $token]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_reset_tokens')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email);
          $user->update([
              'password' => Hash::make($request->password)
          ]);

          DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

          return redirect('/login')->with('success', 'Password anda berhasil diubah, Silahkan login!');
      }
}
