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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("subject");
            $table->text("message");
            $table->timestamps();
        });

        DB::table('messages')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'subject' => 'This is test subject',
                'message' => "This is test message"
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
