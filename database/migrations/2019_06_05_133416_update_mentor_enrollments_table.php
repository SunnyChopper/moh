<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMentorEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_enrollments', function (Blueprint $table) {
            $table->integer('trial');
            $table->double('sa_score')->nullable();
            $table->double('f_score')->nullable();
            $table->double('sd_score')->nullable();
            $table->double('ha_score')->nullable();
            $table->double('he_score')->nullable();
            $table->double('sf_score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentor_enrollments', function (Blueprint $table) {
            $table->dropColumn('trial');
            $table->dropColumn('sa_score');
            $table->dropColumn('f_score');
            $table->dropColumn('sd_score');
            $table->dropColumn('ha_score');
            $table->dropColumn('he_score');
            $table->dropColumn('sf_score');
        });
    }
}
