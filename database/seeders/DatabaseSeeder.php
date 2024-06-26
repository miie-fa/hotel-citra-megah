<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User Biasa',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 0,
        ]);

        // Buat admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 1,
        ]);

        DB::table('settings')->insert([
            'logo' => 'https://cdn-icons-png.flaticon.com/512/666/666201.png',
            'favicon' => 'https://seeklogo.com/images/W/web-icon-logo-A6B586D114-seeklogo.com.png',
            'name' => 'Website Name',
            'phone' => 0000,
            'email' => 'site@name.com',
            'address' => 'address',
            'facebook' => 'facebook',
            'linkedin' => 'linkedin',
            'instagram' => 'instagram',
            'twitter' => 'twitter',
            'analytic_id' => 'analytic_id',
        ]);

        DB::table('notifies')->insert([ 
            'payment_notif' => 'Selamat Anda Telah Memesan Kamar Di Hotel Citra Megah Silahkan lakukan Pembayarn Melalui Link Berikut',
            'payment_success' => 'Pembayaran Kamu Berhasil, Hotel Citra Megah',
            'payment_failed' => 'Yah Pembayaran Kamu Gagal, Terimakasih sudah memesan Kamar Di Website Hotel Citra Megah',
        ]);

        // \App\Models\User::factory(10)->create();

        // $user1 = User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@test.com',
        // ]);

        // $user2 = User::factory()->create([
        //     'name' => 'Customer',
        //     'email' => 'customer@test.com',
        // ]);

        // $role = Role::create(['name' => 'admin']);
        // $user1->assignRole($role);

        // $role = Role::create(['name' => 'customer']);
        // $user2->assignRole($role);
    }
}