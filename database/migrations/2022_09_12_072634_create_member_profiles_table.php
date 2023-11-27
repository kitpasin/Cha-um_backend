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
        Schema::create('member_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer("member_id");
            $table->integer("profile_index")->default(1);
            $table->string("firstname")->nullable();
            $table->string("lastname")->nullable();
            $table->string("gender")->nullable();
            $table->dateTime("birthday")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("address")->nullable();
            $table->string("moo")->nullable();
            $table->string("district")->nullable();
            $table->string("subdistrict")->nullable();
            $table->string("province")->nullable();
            $table->string("zipcode")->nullable();
            $table->string("note")->nullable();
            $table->boolean("is_delete")->default(false);
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
        Schema::dropIfExists('member_profiles');
    }
};
