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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->string('slug')->nullable();
            $table->string('title');
            $table->string('keyword')->nullable();
            $table->string('description');
            $table->text('freetag')->nullable();
            $table->string('h1')->nullable();
            $table->string('h2')->nullable()->nullable();
            $table->text('short_url')->nullable()->nullable();
            $table->string('thumbnail_title')->nullable();
            $table->string('thumbnail_link')->nullable();
            $table->string('thumbnail_size')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->string('topic')->nullable();
            $table->text('content')->nullable();
            $table->text('iframe')->nullable();
            $table->text('category');
            $table->text('tags')->nullable();
            $table->text('redirect')->nullable();
            $table->text('link_facebook')->nullable();
            $table->text('link_twitter')->nullable();
            $table->text('link_instagram')->nullable();
            $table->text('link_youtube')->nullable();
            $table->text('link_line')->nullable();
            $table->dateTime('date_begin_display')->nullable();
            $table->dateTime('date_end_display')->nullable();
            $table->boolean('status_display')->default(false);
            $table->boolean('pin')->default(false);
            $table->boolean('defaults')->default(false);
            $table->integer('post_view')->default(0);
            $table->integer('priority')->default(1);
            $table->string('meta_tag')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('allow_delete')->default(false)->comment("ถ้าเป็น true ลบได้เฉพาะ SuperAdmin");
            $table->boolean('is_maincontent')->default(false)->comment("ถ้าเป็น false = dynamic content");
            $table->integer('last_update_by')->nullable();
            $table->timestamps();
            $table->unique(['language','slug']);
        });
        DB::statement('ALTER TABLE `posts` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `language`) USING BTREE');
        DB::table('posts')->insert([
            [
                'id' => 1,
                'language' => 'th',
                'title' => 'Create Garden Design excellent work.',
                'keyword' => '',
                'description' => 'บร็อคโคลีทาวน์แดนเซอร์บรรพชนพาสตาเทอร์โบบลอโครนาซีเรียสว้าวแรลลีโหงวมัฟฟินแจ๊กพอตออโต้พาร์ตเนอร์คอลัมน์แมนชั่นเพียวคำสาปสแตนฮ่องเต้พุทโธ',
                'content' => '',
                'category' => ',1,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/home-banner-logo.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 2,
                'language' => 'th',
                'title' => 'We are focused to create excellent work.',
                'keyword' => '',
                'description' => 'เรามุ่งมั่นสร้างสรรค์ผลงานที่เป็นเลิศ',
                'content' => '',
                'category' => ',1,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => '',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 3,
                'language' => 'th',
                'title' => 'สินค้าของเรา',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',2,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/product-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 4,
                'language' => 'th',
                'title' => 'วัสดุ และอุปกรณ์การเกษตร',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',2,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/product-material&tool-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 5,
                'language' => 'th',
                'title' => 'ครุภัณฑ์ณ์การเกษตร',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',2,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/product-equipment-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 6,
                'language' => 'th',
                'title' => 'พันธุ์พืช และ พันธุ์สัตว์',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',2,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/product-specie-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 7,
                'language' => 'th',
                'title' => 'ออกแบบและจำหน่ายบรรจุภัณฑ์ทางการเกษตร',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',2,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/product-packaging-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 8,
                'language' => 'th',
                'title' => 'ผลงานของเรา',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',3,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/portfolio-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 9,
                'language' => 'th',
                'title' => 'บริการของเรา',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 10,
                'language' => 'th',
                'title' => 'ตัดหญ้า ดูแล และบำรุงรักษา สวนสาธารณะ',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-park-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 11,
                'language' => 'th',
                'title' => 'ตัดหญ้า Airside และ Landside',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-airside&landside-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 12,
                'language' => 'th',
                'title' => 'ดูแลปรับปรุงภูมิทัศน์',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-improve-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 13,
                'language' => 'th',
                'title' => 'ออกแบบจัดสวน จัดประดับตกแต่งไม้ดอกไม้ประดับ',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-garden-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 14,
                'language' => 'th',
                'title' => 'จ้างเหมาทำความสะอาด แลเก็บสิ่งแปลกปลอม',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-cleaning-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 15,
                'language' => 'th',
                'title' => 'งานป้องกันอันตรายต่อการบิน',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-protect-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 16,
                'language' => 'th',
                'title' => 'บริการติดตั้งระบบโซล่าเซลล์',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-solarcell-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 17,
                'language' => 'th',
                'title' => 'บริการตัดแต่ง และโค่นต้นไม่ใหญ่',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',4,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/service-pruning&cutdown-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 18,
                'language' => 'th',
                'title' => 'ขั้นตอนการทำงาน',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',5,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/process-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 19,
                'language' => 'th',
                'title' => 'TURN-KEY SERVICES',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',5,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/process-turnkey-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 20,
                'language' => 'th',
                'title' => 'LANDSCAPE DESIGN SERVICES',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',5,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/process-landscape-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 21,
                'language' => 'th',
                'title' => 'PLANTING AND CONSTRUCTION SERVICES',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',5,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/process-planting-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 22,
                'language' => 'th',
                'title' => 'MAINTENANCE SERVICES',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',5,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/process-maintenance-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 23,
                'language' => 'th',
                'title' => 'Design',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',6,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/design-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
            ],
            [
                'id' => 24,
                'language' => 'th',
                'title' => 'Contact us',
                'keyword' => '',
                'description' => 'บริการครบจบที่เรา ทั้ง ออกแบบ จำหน่าย จัดสวน และ ดูแลสวน',
                'content' => '',
                'category' => ',6,',
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => true,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/contact-banner.png',
                'priority' => 1,
                'iframe' => '',
                'redirect' => null,
                'freetag' => ''
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
        Schema::dropIfExists('posts');
    }
};
