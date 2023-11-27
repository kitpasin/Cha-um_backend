<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('portfolio_id')->nullable();
            $table->integer('design_id')->nullable();
            $table->integer('post_id')->nullable();
            $table->string('image_link');
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('position')->default(1);
            $table->string('language')->nullable();
            $table->string('defaults')->default(0);
            $table->integer('update_by')->nullable();
            $table->timestamps();
        });

        DB::table('post_images')->insert([
            [
                'post_id' => 1,
                'image_link' => 'images/home-banner-1.png',
                'alt' => '',
                'title' => '',
                'description' => '',
                'position' => 1,
                'language' => 'th',
            ],
            [
                'post_id' => 1,
                'image_link' => 'images/home-banner-2.png',
                'alt' => '',
                'title' => '',
                'description' => '',
                'position' => 2,
                'language' => 'th',
            ],
            [
                'post_id' => 1,
                'image_link' => 'images/home-banner-3.png',
                'alt' => '',
                'title' => '',
                'description' => '',
                'position' => 3,
                'language' => 'th',
            ],
            [
                'post_id' => 2,
                'image_link' => 'images/home-about-1.png',
                'alt' => 'ออสซี่ลาตินโอ้ย อาข่า นิวเฟิร์ม โทรโข่งเอ๋จูนไอติม คาเฟ่แมคเคอเรลบู๊มอคคาแคชเชียร์สกายวานิลลาวาซาบิอวอร์ด แชมเปี้ยน',
                'title' => 'สวนธรรมชาติ',
                'description' => '',
                'position' => 1,
                'language' => 'th',
            ],
            [
                'post_id' => 2,
                'image_link' => 'images/home-about-2.png',
                'alt' => 'ออสซี่ลาตินโอ้ย อาข่า นิวเฟิร์ม โทรโข่งเอ๋จูนไอติม คาเฟ่แมคเคอเรลบู๊มอคคาแคชเชียร์สกายวานิลลาวาซาบิอวอร์ด แชมเปี้ยน',
                'title' => 'ทีมออกแบบที่มีประสบการณ์',
                'description' => '',
                'position' => 2,
                'language' => 'th',
            ],
            [
                'post_id' => 2,
                'image_link' => 'images/home-about-3.png',
                'alt' => 'ออสซี่ลาตินโอ้ย อาข่า นิวเฟิร์ม โทรโข่งเอ๋จูนไอติม คาเฟ่แมคเคอเรลบู๊มอคคาแคชเชียร์สกายวานิลลาวาซาบิอวอร์ด แชมเปี้ยน',
                'title' => 'การัณตีความพอใจ',
                'description' => '',
                'position' => 3,
                'language' => 'th',
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
        Schema::dropIfExists('post_images');
    }
};
