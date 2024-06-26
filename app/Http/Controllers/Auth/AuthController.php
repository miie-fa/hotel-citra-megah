<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\NotificationFontee;
use App\Models\Setting;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{

    use Fonnte;

    public function __construct()
    {
        $this->middleware('guest', [
            'except' => [
                'logout',
                'verifyEmailProcess',
                'verifyEmailSuccess',
                'verifyEmail',
                'sendEmailVerification',
                'resendEmailVerification'
            ]
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        $user = User::where('email', $request->email)->first();

        if ($user && $user->active == 0) {
            session(['user_phone' => $user->phone]);

            return redirect()->route('activication');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        $settings = Setting::first();

        return view('front.auth.register', compact('settings'));
    }

    public function registerProcess(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:50', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'confirmed'],
        ]);

        $notify = NotificationFontee::firstOrFail();
        $data['notify_id'] = $notify->id;
        $data['token'] = rand(111111,999999);
        $user = User::create($data);

        Mail::to($user->email)->send(new VerifyEmail($user));

        $messages = "Halo kak, Selamat anda berhasil Mendaftar akun Hotel Citra Megah, ini kode OTP anda Jangan beri ini kepada Siapapun $user->token";

        $this->send_message($user->phone,$messages);

        try{
            session(['user_phone' => $user->phone]);
            return redirect()->route('activication');
        }catch(\Throwable $th){
            throw $th;

            return back()->withInput();
        }

        return back()->withInput();
    }

    public function activication(){
        $userPhone = session('user_phone');
        $settings = Setting::first();

        return view('front.auth.activication', compact('userPhone', 'settings'));
    }

    public function activication_process (Request $request){

        $user = User::where('token', $request->token)->first();

        if ($user){
            $user->update([
                'active' => 1,
            ]);

        }
        return redirect()->route('login')->with('success', 'Verifikasi Berhasil Silahkan Login Kembali !!');

        return redirect()->back()->with('error', 'Token Tidak sesuai');
    }

    public function sendEmailVerification()
{
    try {
        $user = auth()->user();

        if (RateLimiter::tooManyAttempts(auth()->user()->email, 3)){
            $seconds = RateLimiter::availableIn(auth()->user()->email);
            $second  = $seconds <= 60 ? $seconds.' detik' : ceil($seconds/60).' menit';
            return redirect()->route('user.dashboard')->with('error', 'Anda sudah melakukan 6 kali percobaan silahkan tunggu '.$second.' lagi untuk mencoba kirim kembali');
        }

        $token = Crypt::encrypt($user->password);

        $actionLink = route('verification.process', $token);
        $body = 'Silahkan Verifikasi Email anda dari website <strong>Hotel Citra Megah</strong> akun dengan email <strong>'.$user->email.'</strong>, Verifikasi Email anda dengan mengklik link berikut';

        RateLimiter::hit($user->email, 1800);

        Mail::send('email.email-verification', compact('body', 'actionLink'), function($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verifikasi Email');
        });

        RateLimiter::clear($user->email);

        return redirect()->route('user.dashboard')->with('success', 'Email verifikasi telah dikirim!');
    } catch (\Throwable $e) {
        return redirect()->route('user.dashboard')->with('error', $e->getMessage());
    }
}


    public function verifyEmailProcess($token)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        $user            = auth()->user();
        $token_decrypted = Crypt::decryptString($token);

        if (explode('"', $token_decrypted)[1] != $user->password){
            return redirect()->route('verification')->with('error', 'Token tidak valid');
        }

        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            "email_verified_at" => Date('Y-m-d'),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Terima Kasih Sudah Memverifikasi Email Anda!!');
    }

    public function resendEmailVerification()
    {

        $is_send_email = $this->sendEmailVerification();

        if (gettype($is_send_email) == 'string'){
            $type    = 'error';
            $message = $is_send_email;
        }else {
            $type    = 'success';
            $message = 'Berhasil kirim email verifikasi';
        }

        $this->sendEmailVerification();
        return redirect()->route('verification')->with($type, $message);
    }

    public function verifyEmail()
    {
        $settings = Setting::first();

        return view('front.auth.email-verification', compact('settings'));
    }

    public function login()
    {
        $settings = Setting::first();

        return view('front.auth.login', compact('settings'));
    }

    public function loginProcess(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            // Jika login berhasil, reset hitungan login gagal
            $request->session()->forget('login_attempts');

            if (auth()->user()->role == 'user') {
                return redirect()->route('home')->with('success', 'Successfuly logged in');
            }else{
                return redirect()->route('filament.admin.pages.dashboard');
            }
        }else{
            // Jika login gagal, tambahkan hitungan login gagal
            $attempts = $request->session()->get('login_attempts') ?? 0;
            $request->session()->put('login_attempts', ++$attempts);

            // Jika mencapai 3 kali percobaan, tampilkan pesan error dan opsi lupa password
            if ($attempts >= 3) {
                return redirect()->route('login')
                    ->with('danger','Anda telah salah memasukkan password 3 kali. Silakan coba lagi nanti atau gunakan opsi lupa password.');
            } else {
                return redirect()->route('login')
                    ->with('danger','Email-Address Or Password Are Wrong.');
            }
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->back()->with('success', 'Successfully logged out');
    }
}
