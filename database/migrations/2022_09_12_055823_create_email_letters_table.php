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
        Schema::create('email_letters', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('email_status');
            $table->string('language');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `email_letters` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `language`) USING BTREE');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_letters');
    }
};
