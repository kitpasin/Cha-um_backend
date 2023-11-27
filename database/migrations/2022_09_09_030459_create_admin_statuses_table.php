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
        Schema::create('admin_statuses', function (Blueprint $table) {
            $table->id();
            $table->text('status_name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::table('admin_statuses')->insert([
            [ 'id' => 1, 'status_name' => 'active' ],
            [ 'id' => 2, 'status_name' => 'pending' ],
            [ 'id' => 3, 'status_name' => 'banned' ],
            [ 'id' => 4, 'status_name' => 'inactive' ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_statuses');
    }
};
