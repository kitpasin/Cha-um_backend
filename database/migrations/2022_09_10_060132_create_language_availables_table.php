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
        Schema::create('language_availables', function (Blueprint $table) {
            $table->id();
            $table->string('abbv_name');
            $table->string('name');
            $table->string('flag')->nullable();
            $table->boolean('defaults')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::table('language_availables')->insert([
            // [ 'id' => 1, 'abbv_name' => 'fr', 'flag' => 'upload/2022/10/11/th16654739570.png', 'name' => 'French' , "defaults" => 1],
            // [ 'id' => 2, 'abbv_name' => 'en', 'flag' => 'upload/2022/10/11/th1216654739700.png', 'name' => 'English', "defaults" => 0],
            [ 'id' => 1, 'abbv_name' => 'th', 'flag' => 'upload/2023/11/15/th17000130310.jpg', 'name' => 'Thai' , "defaults" => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language_availables');
    }
};
