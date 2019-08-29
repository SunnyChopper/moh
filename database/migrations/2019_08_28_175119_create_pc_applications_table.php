<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 128);
            $table->string('last_name', 128)->nullable();
            $table->string('email', 128);
            $table->string('phone', 64);
            $table->string('timezone', 128)->nullable();
            $table->time('call_time');
            $table->integer('years');
            $table->integer('determination_score');
            $table->text('strengths');
            $table->text('weaknesses');
            $table->text('why');
            $table->text('purpose');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('pc_applications');
    }
}
