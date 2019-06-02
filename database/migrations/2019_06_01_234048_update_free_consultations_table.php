<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFreeConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('free_consultations', function (Blueprint $table) {
            $table->string('skype_id', 128)->nullable()->change();
            $table->string('app', 128)->nullable();
            $table->string('contact', 512)->nullable();
            $table->date('meeting_date')->nullable();
            $table->time('meeting_time')->nullable();
            $table->string('timezone', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('free_consultations', function (Blueprint $table) {
            $table->string('skype_id', 128)->change();
            $table->dropColumn('app');
            $table->dropColumn('contact');
            $table->dropColumn('meeting_date');
            $table->dropColumn('meeting_time');
            $table->dropColumn('timezone');
        });
    }
}
