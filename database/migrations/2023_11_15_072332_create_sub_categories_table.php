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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('main_cate_id')->nullable();
            $table->string('cate_name')->nullable();
            $table->string('cate_title')->nullable();
            $table->string('cate_keyword')->nullable();
            $table->string('cate_description')->nullable();
            $table->string('cate_thumbnail_link')->nullable();
            $table->string('cate_thumbnail_title')->nullable();
            $table->string('cate_thumbnail_alt')->nullable();
            $table->string('cate_url')->nullable();
            $table->string('cate_topic')->nullable();
            $table->string('cate_h1')->nullable();
            $table->string('cate_h2')->nullable();
            $table->string('cate_freetag')->nullable();
            $table->string('cate_attr')->nullable();
            $table->string('cate_redirect')->nullable();
            $table->integer('cate_parent_id')->default(0);
            $table->integer('cate_root_id')->default(0);
            $table->integer('cate_level')->default(0);
            $table->boolean('cate_status_display')->default(true);
            $table->boolean('is_menu')->default(false);
            $table->boolean('is_topside')->default(false);
            $table->boolean('is_leftside')->default(false);
            $table->boolean('is_rightside')->default(false);
            $table->boolean('is_bottomside')->default(false);
            $table->integer('cate_priority')->default(1);
            $table->integer('cate_position')->default(1);
            $table->boolean('on_product')->default(false); //('ถ้าเป็น false จะใช้สำหรับ content category');
            $table->boolean('is_main_page')->default(true);
            $table->dateTime('cate_date_display')->nullable();
            $table->dateTime('cate_date_hidden')->nullable();
            $table->string('language');
            $table->boolean('defaults')->default(false);
            $table->timestamps();
            $table->unique(['language','cate_url']);
        });
        DB::statement('ALTER TABLE `sub_categories` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `language`) USING BTREE');
    
        DB::table('sub_categories')->insert([
            [
                'id' => 1,
                'main_cate_id' => '2',
                'cate_url' => 'product/material&tool',
                'cate_title' => 'วัสดุ และอุปกรณ์การเกษตร',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 2,
                'main_cate_id' => '2',
                'cate_url' => 'product/equipment',
                'cate_title' => 'ครุภัณฑ์ณ์การเกษตร',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 2,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 3,
                'main_cate_id' => '2',
                'cate_url' => 'product/specie',
                'cate_title' => 'พันธุ์พืช และ พันธุ์สัตว์',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 3,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 4,
                'main_cate_id' => '2',
                'cate_url' => 'product/packaging',
                'cate_title' => 'ออกแบบและจำหน่ายบรรจุภัณฑ์ทางการเกษตร',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 4,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 5,
                'main_cate_id' => '4',
                'cate_url' => 'service/park',
                'cate_title' => 'ตัดหญ้า ดูแล และบำรุงรักษา สวนสาธารณะ',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 6,
                'main_cate_id' => '4',
                'cate_url' => 'service/airside&landside',
                'cate_title' => 'ตัดหญ้า Airside และ Landside',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 2,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 7,
                'main_cate_id' => '4',
                'cate_url' => 'service/improve',
                'cate_title' => 'ดูแลปรับปรุงภูมิทัศน์',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 3,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 8,
                'main_cate_id' => '4',
                'cate_url' => 'service/garden',
                'cate_title' => 'ออกแบบจัดสวน จัดประดับตกแต่งไม้ดอกไม้ประดับ',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 4,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 9,
                'main_cate_id' => '4',
                'cate_url' => 'service/cleaning',
                'cate_title' => 'จ้างเหมาทำความสะอาด แลเก็บสิ่งแปลกปลอม',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 5,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 10,
                'main_cate_id' => '4',
                'cate_url' => 'service/protect',
                'cate_title' => 'งานป้องกันอันตรายต่อการบิน',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 6,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 11,
                'main_cate_id' => '4',
                'cate_url' => 'service/solarcell',
                'cate_title' => 'บริการติดตั้งระบบโซล่าเซลล์',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 7,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 12,
                'main_cate_id' => '4',
                'cate_url' => 'service/pruning&cutdown',
                'cate_title' => 'บริการตัดแต่ง และโค่นต้นไม่ใหญ่',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 8,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 13,
                'main_cate_id' => '5',
                'cate_url' => 'process/turnkey',
                'cate_title' => 'TURN-KEY SERVICES',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 14,
                'main_cate_id' => '5',
                'cate_url' => 'process/landscape',
                'cate_title' => 'LANDSCAPE DESIGN SERVICES',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 2,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 15,
                'main_cate_id' => '5',
                'cate_url' => 'process/planting',
                'cate_title' => 'PLANTING AND CONSTRUCTION SERVICES',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 3,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 16,
                'main_cate_id' => '5',
                'cate_url' => 'process/maintenance',
                'cate_title' => 'MAINTENANCE SERVICES',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 4,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 17,
                'main_cate_id' => '6',
                'cate_url' => 'etc/design',
                'cate_title' => 'Design',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 1,
                'language' => 'th',
                'defaults' => true
            ],
            [
                'id' => 18,
                'main_cate_id' => '6',
                'cate_url' => 'etc/contact',
                'cate_title' => 'Contact us',
                'is_menu' => true,
                'is_topside' => true,
                'is_bottomside' => true,
                'cate_position' => 2,
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
        Schema::dropIfExists('sub_categories');
    }
};
