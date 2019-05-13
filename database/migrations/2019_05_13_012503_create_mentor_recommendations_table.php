<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title', 128);
            $table->text('description')->nullable();
            $table->string('link', 256);
            $table->integer('type');
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
        Schema::dropIfExists('mentor_recommendations');
    }
}
