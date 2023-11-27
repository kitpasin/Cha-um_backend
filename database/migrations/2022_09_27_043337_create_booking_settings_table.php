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
        Schema::create('booking_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('people_number')->default(0);
            $table->string('available_time')->nullable();
            $table->string('disable_by_date')->nullable();
            $table->string('disable_by_day')->nullable();
            $table->string('special_holiday')->nullable();
            $table->timestamps();
        });

        DB::table('booking_settings')->insert([
            [
                'people_number' => '5',
                'available_time' => ',15:30,16:00,17.30,',
                'disable_by_date' => ',15,17,',
                'disable_by_day' => ',sun,sat,',
                'special_holiday' => ',12-12,11-11,'
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
        Schema::dropIfExists('booking_settings');
    }
};
