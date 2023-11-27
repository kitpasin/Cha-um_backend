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
        Schema::create('leave_messages', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('topic')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('new');
            $table->boolean('favorite')->default(false);
            $table->string('language');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `leave_messages` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `language`) USING BTREE');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_messages');
    }
};
