<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAppHabitsTableAddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_habits', function(Blueprint $table) {
            $table->bigInteger('current_level')->nullable();
            $table->foreign('current_level')->references('id')->on('app_habit_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_habits', function (Blueprint $table) {
            $table->dropColumn('current_level');
        });
    }
}
