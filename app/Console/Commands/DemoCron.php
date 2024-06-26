<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\User;
use App\Traits\Fonnte;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DemoCron extends Command
{
    use Fonnte;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Sample
        Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));

        // Kita bisa menyimpan logic disini
        // Contoh: Update data di database yang statusnya belum diproses selama 24 jam menjadi FAILED

        $order = Order::all();

        foreach ($order as $orders) {
            if ($orders->status == 'PENDING') {
                // $times  = strtotime($orders->created_at) + (86400 * 1);
                $times  = strtotime($orders->created_at) + (60 * 1);
                if ($times < time()) {
                    $orders->update([
                        'status' => 'EXPIRED',
                    ]);
                    $user = User::where('id', $orders->id_users)->get();
                    $send = 'Kepada yang terhormat Bapak / ibu ' . $user->name . 'Kami informasikan ada pembayaram yang sudah expired jika ingin membayar silahkan membayar ulang';
                    $this->send_message($user->telepon, $send);
                    Log::info($user);
                    Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));
                }
            }
        }
    }
}
