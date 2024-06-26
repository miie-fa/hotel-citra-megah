<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->bigInteger('price');
            $table->integer('total_rooms');
            $table->text('amenities')->nullable();
            $table->text('size')->nullable();
            $table->text('bed_type')->nullable();
            $table->integer('adults')->nullable();
            $table->integer('childrens')->nullable();
            $table->integer('total_bathrooms')->nullable();
            $table->text('featured_photo')->nullable();
            $table->text('video_id')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};