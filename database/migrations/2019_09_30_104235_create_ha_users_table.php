<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ha_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 128);
            $table->string('email', 256);
            $table->string('password', 256);
            $table->string('profile_image_url', 256);
            $table->integer('reward_points')->default(0);
            $table->integer('backend_auth')->default(0);
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('ha_users');
    }
}
