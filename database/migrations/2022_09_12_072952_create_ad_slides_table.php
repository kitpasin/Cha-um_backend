<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_slides', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->default(0);
            $table->string('ad_image');
            $table->string('ad_image_alt')->nullable();
            $table->string('ad_image_title')->nullable();
            $table->string('ad_title')->nullable();
            $table->string('ad_description')->nullable();
            $table->integer('ad_type')->default(1)->comment('1: ภาพหน้าหลัก, 2: ภาพโฆษณา');
            $table->integer('ad_position_id')->default(1);
            $table->integer('ad_priority')->default(1);
            $table->string('ad_link')->nullable();
            $table->string('ad_redirect')->nullable();
            $table->string('ad_h1')->nullable();
            $table->string('ad_h2')->nullable();
            $table->boolean('ad_status_display')->default(true);
            $table->dateTime('ad_date_display')->nullable();
            $table->dateTime('ad_date_hidden')->nullable();
            $table->string('language')->nullable();
            $table->string('defaults')->default(false);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `ad_slides` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `language`) USING BTREE');

        DB::table('ad_slides')->insert([
            [
                'page_id' => 1,
                'ad_title' => '',
                'ad_description' => '',
                'ad_image' => 'images/slide-food.png',
                'ad_position_id' => 2,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 1,
                'ad_title' => '',
                'ad_description' => '',
                'ad_image' => 'images/slide-food.png',
                'ad_position_id' => 2,
                'ad_priority' => 2,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 1,
                'ad_title' => '',
                'ad_description' => '',
                'ad_image' => 'images/slide-food.png',
                'ad_position_id' => 2,
                'ad_priority' => 3,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 2,
                'ad_title' => 'Menu',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/banner-menu.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 3,
                'ad_title' => 'CATERING',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/bg-catering.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 4,
                'ad_title' => 'GALLERY',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/bg-gallery.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 5,
                'ad_title' => 'delivery',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/bg-gallery.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 6,
                'ad_title' => 'about us',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/bg-about.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 7,
                'ad_title' => 'our location',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/bg-location.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 8,
                'ad_title' => 'Contact us',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/bg-contactus.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'page_id' => 9,
                'ad_title' => 'book',
                'ad_description' => 'Tamarind was born from the desire of two sisters to unite their passion and ambition. The first, a talented chef, wanted to share her passion for the cuisine of her homeland. The second, who grew up in France, allied her ambition with a sense of reconnecting with her roots.',
                'ad_image' => 'images/bg-book.png',
                'ad_position_id' => 1,
                'ad_priority' => 1,
                'language' => 'th',
                'defaults' => true
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_slides');
    }
};
