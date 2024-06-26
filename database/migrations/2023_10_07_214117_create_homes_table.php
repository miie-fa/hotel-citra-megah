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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();

            $table->string('sec_1_title');
            $table->text('sec_1_subtitle');
            $table->string('sec_1_limit');
            $table->boolean('sec_1_is_view')->default(true);


            $table->text('sec_2_image')->nullable();
            $table->string('sec_2_title');
            $table->text('sec_2_subtitle');
            $table->string('sec_2_button');
            $table->string('sec_2_button_target');
            $table->boolean('sec_2_is_view')->default(true);


            $table->text('sec_3_image')->nullable();
            $table->string('sec_3_title');
            $table->text('sec_3_subtitle');

            $table->string('sec_3_icon_1');
            $table->string('sec_3_title_1');
            $table->text('sec_3_subtitle_1');

            $table->string('sec_3_icon_2');
            $table->string('sec_3_title_2');
            $table->text('sec_3_subtitle_2');

            $table->string('sec_3_icon_3');
            $table->string('sec_3_title_3');
            $table->text('sec_3_subtitle_3');

            $table->boolean('sec_3_is_view')->default(true);


            $table->string('sec_4_title');
            $table->string('sec_4_button');
            $table->string('sec_4_button_target');
            $table->string('sec_4_limit');
            $table->boolean('sec_4_is_view')->default(true);


            $table->string('sec_5_title');
            $table->text('sec_5_subtitle');

            $table->text('sec_5_image_1')->nullable();
            $table->string('sec_5_title_1');

            $table->text('sec_5_image_2')->nullable();
            $table->string('sec_5_title_2');

            $table->text('sec_5_image_3')->nullable();
            $table->string('sec_5_title_3');

            $table->boolean('sec_5_is_view')->default(true);


            $table->string('sec_6_title');
            $table->text('sec_6_subtitle');

            $table->text('sec_6_image_1')->nullable();
            $table->string('sec_6_title_1');
            $table->text('sec_6_subtitle_1');

            $table->text('sec_6_image_2')->nullable();
            $table->string('sec_6_title_2');
            $table->text('sec_6_subtitle_2');

            $table->text('sec_6_image_3')->nullable();
            $table->string('sec_6_title_3');
            $table->text('sec_6_subtitle_3');

            $table->boolean('sec_6_is_view')->default(true);



            $table->string('sec_7_title');
            $table->text('sec_7_subtitle');

            $table->string('sec_7_limit');

            $table->boolean('sec_7_is_view')->default(true);


            $table->string('sec_8_title');
            $table->boolean('sec_8_is_view')->default(true);


            $table->text('sec_9_title');
            $table->string('sec_9_button');
            $table->string('sec_9_button_target');
            $table->boolean('sec_9_is_view')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
