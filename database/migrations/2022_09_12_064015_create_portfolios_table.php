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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->string('slug')->nullable();
            $table->integer('sub_cate_id');
            $table->string('title');
            $table->string('keyword')->nullable();
            $table->string('description');
            $table->string('address');
            $table->string('size');
            $table->string('status');
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
            $table->text('category')->default(3);
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
        DB::statement('ALTER TABLE `portfolios` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `language`) USING BTREE');

        DB::table('portfolios')->insert([
            [
                'id' => 1,
                'sub_cate_id' => 3,
                'language' => 'th',
                'slug' => '',
                'title' => 'งานเชียงรายดอกไม้งาม',
                'keyword' => '',
                'description' => 'งานเชียงรายดอกไม้งาม',
                'address' => 'จังหวัดเชียงราย',
                'size' => '7500 sqf internal | 3500 sqf external.',
                'status' => 'เสร็จสมบูรณ์',
                'content' => 'Sited within the valley of the eastern-most seaside town of Wategos Beach, Larus Marinus is a multigenerational family retreat that perches lightly on the steeply contoured site, overlooking the Pacific Ocean. Responding to the client’s brief, the project is part of a multigenerational arrangement in which a mother and her daughter’s family sought to establish a new mode of living with the flexibility of two dwellings.',
                'category' => 3,
                'status_display' => true,
                'defaults' => true,
                'pin' => true,
                'is_maincontent' => false,
                'thumbnail_title' => '',
                'thumbnail_link' => 'images/portfolio-1.png',
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
        Schema::dropIfExists('portfolios');
    }
};
