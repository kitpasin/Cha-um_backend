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
        Schema::create('ad_slide_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('name');
            $table->string('dimension'); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    
        #MOCKUP
        DB::table('ad_slide_positions')->insert([
            [ 
                'position' => 'B-A1', 
                'name' => 'banner', 
                'dimension' => '1600*500'
            ],
            [ 
                'position' => 'S-A1', 
                'name' => 'slide', 
                'dimension' => '1600*500'
            ],
            [ 
                'position' => 'intro', 
                'name' => 'intro', 
                'dimension' => '768*768'
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
        Schema::dropIfExists('ad_slide_positions');
    }
};
