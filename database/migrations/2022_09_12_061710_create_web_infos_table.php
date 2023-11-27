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
        Schema::create('web_infos', function (Blueprint $table) {
            $table->id('info_id');
            $table->string('info_type')->nullable();
            $table->string('info_param');
            $table->string('info_title')->nullable();
            $table->text('info_value')->nullable();
            $table->text('info_link')->nullable();
            $table->text('info_iframe')->nullable();
            $table->string('info_attribute')->nullable();
            $table->integer('info_priority')->default(1);
            $table->boolean('info_display')->default(true);
            $table->boolean('admin_level')->comment('สิทธิ์เข้าถึงข้อมูล');
            $table->string('language');
            $table->boolean('defaults')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->unique(['language', 'info_param']);
        });

        // footer
        DB::statement('ALTER TABLE `web_infos` DROP PRIMARY KEY, ADD PRIMARY KEY (`info_id`, `language`) USING BTREE');

        DB::table('web_infos')->insert([
            [
                'info_id' => 1,
                 'info_id' => 1,
                 'info_type' => 1,
                 'info_param' => "webname",
                   'info_title' => "ชื่อเว็บไซต์ #1",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 2,
                 'info_id' => 2,
                 'info_type' => 1,
                 'info_param' => "extraname",
                 'info_title' => "ชื่อเว็บไซต์ #2",
                 'info_priority' => 3,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 3,
                 'info_id' => 3,
                 'info_type' => 1,
                 'info_param' => "companyname",
                 'info_title' => "ชื่อบริษัท / ชื่อร้านค้า",
                 'info_priority' => 3,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 4,
                 'info_id' => 4,
                 'info_type' => 1,
                 'info_param' => "image_1",
                   'info_title' => "Image #1 (Primary)",
                 'info_priority' => 3,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 5,
                 'info_id' => 5,
                 'info_type' => 1,
                 'info_param' => "image_2",
                   'info_title' => "Image #2 (Primary)",
                 'info_priority' => 4,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 6,
                 'info_id' => 0,
                 'info_type' => 1,
                 'info_param' => "image_3",
                   'info_title' => "Image #3 (Primary)",
                 'info_priority' => 4,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 7,
                 'info_id' => 0,
                 'info_type' => 1,
                 'info_param' => "image_4",
                   'info_title' => "Image #4 (Primary)",
                 'info_priority' => 5,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 8,
                 'info_id' => 0,
                 'info_type' => 1,
                 'info_param' => "favicon",
                   'info_title' => "Image favicon (Primary)",
                    'info_priority' => 6,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 9,
                 'info_id' => 0,
                 'info_type' => 2,
                 'info_param' => "email",
                   'info_title' => "อีเมลหลัก",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'tamarindthairestaurant@gmail.com',
                 'info_link' => '/icons/email.png',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 10,
                 'info_id' => 0,
                 'info_type' => 3,
                 'info_param' => "address",
                 'info_title' => "ที่อยู่ / บ้านเลขที่",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'Tamarind Thai Restaurant 33',
                 'info_link' => '/icons/Our-location.png',
                 'info_iframe' => '',
                 'info_attribute' => 'Our location'
            ],
            [
                'info_id' => 11,
                 'info_id' => 0,
                 'info_type' => 3,
                 'info_param' => "district",
                 'info_title' => "เขต / อำเภอ",
                 'info_priority' => 2,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'rue François Miron',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 12,
                 'info_id' => 0,
                 'info_type' => 3,
                 'info_param' => "subdistrict",
                 'info_title' => "แขวง / ตำบล",
                 'info_priority' => 3,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 13,
                 'info_id' => 0,
                 'info_type' => 3,
                 'info_param' => "province",
                 'info_title' => "จังหวัด",
                 'info_priority' => 4,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'Paris.',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 14,
                 'info_id' => 0,
                 'info_type' => 3,
                 'info_param' => "zipcode",
                 'info_title' => "รหัสไปรษณีย์",
                 'info_priority' => 5,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '75004',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 15,
                 'info_id' => 0,
                 'info_type' => 3,
                 'info_param' => "google_map",
                 'info_title' => "แผนที่",
                 'info_priority' => 6,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15303.065993585626!2d102.835101!3d16.487357!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228ae99b598b43%3A0x56b4538d2ace7037!2sWYNNSOFT%20SOLUTION%20CO%2CLTD.!5e0!3m2!1sth!2sth!4v1663915321775!5m2!1sth!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 16,
                 'info_id' => 0,
                 'info_type' => 2,
                 'info_param' => "link_facebook",
                 'info_title' => "เฟซบุ๊ค",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => 'https://www.facebook.com',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 17,
                 'info_id' => 0,
                 'info_type' => 2,
                 'info_param' => "link_twitter",
                 'info_title' => "ทวิตเตอร์",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => 'https://www.twitter.com',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 18,
                 'info_id' => 0,
                 'info_type' => 2,
                 'info_param' => "link_instagram",
                 'info_title' => "อินสตาแกรม",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => 'https://www.instagram.com',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 19,
                 'info_id' => 0,
                 'info_type' => 2,
                 'info_param' => "phone",
                 'info_title' => "เบอร์โทรศัพท์",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '01 48 87 34 20',
                 'info_link' => '/icons/Call-online.png',
                 'info_iframe' => '',
                 'info_attribute' => 'Call online'
            ],
            [
                'info_id' => 20,
                 'info_id' => 0,
                 'info_type' => 4,
                 'info_param' => "terms_of_service",
                 'info_title' => "Terms of service",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 21,
                 'info_id' => 0,
                 'info_type' => 4,
                 'info_param' => "privacy_policy",
                 'info_title' => "Privacy Policy",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 22,
                 'info_id' => 0,
                 'info_type' => 4,
                 'info_param' => "copy_right",
                 'info_title' => "copy right",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => '© 2023 by Tamarind Thai Restaurant.com',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 23,
                 'info_id' => 0,
                 'info_type' => 3,
                 'info_param' => "working_hours",
                 'info_title' => "เวลาทำการ",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'Tuesday – Saturday 12 am – 2.30 pm / 7 pm – 11 pm Sunday 7 pm – 10.30 pm',
                 'info_link' => '/icons/Working-hours.png',
                 'info_iframe' => '',
                 'info_attribute' => 'Working hours'
            ],
            [
                'info_id' => 24,
                 'info_id' => 0,
                 'info_type' => 4,
                 'info_param' => "footer_menu",
                 'info_title' => "menu",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'menu',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 25,
                 'info_id' => 0,
                 'info_type' => 4,
                 'info_param' => "footer_more_info",
                 'info_title' => "more info",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'more info',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 26,
                 'info_id' => 0,
                 'info_type' => 4,
                 'info_param' => "footer_term_privacy",
                 'info_title' => "term privacy",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'term privacy',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
            ],
            [
                'info_id' => 27,
                 'info_id' => 0,
                 'info_type' => 4,
                 'info_param' => "footer_social",
                 'info_title' => "social",
                 'info_priority' => 1,
                 'admin_level' => 3,
                 'language' => "th",
                 'defaults' => 1,
                 'info_value' => 'social',
                 'info_link' => '',
                 'info_iframe' => '',
                 'info_attribute' => ''
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
        Schema::dropIfExists('web_infos');
    }
};
