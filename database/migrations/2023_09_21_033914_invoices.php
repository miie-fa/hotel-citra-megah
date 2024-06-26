<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id');
        $table->foreign('order_id')->references('id')->on('orders');
        $table->string('hotel_info');
        $table->string('customer_info');
        $table->string('order_details');
        $table->string('room_details');
        $table->decimal('price', 8, 2);
        $table->string('payment_method');
        $table->string('cancellation_policy');
        $table->string('check_in_instructions');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
