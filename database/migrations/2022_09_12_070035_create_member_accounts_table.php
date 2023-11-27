<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('member_accounts', function (Blueprint $table) { 
            $table->id();
            $table->integer('account_id');
            $table->string('display_name')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable(); 
            $table->string('cover_image')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('line_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('member_status')->nullable();
            $table->string('member_note')->nullable();
            $table->dateTime('member_verify_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_accounts');
    }
};
