<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_consultations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('skype_id', 256);
            $table->double('sa_percentage');
            $table->double('f_percentage');
            $table->double('sd_percentage');
            $table->double('ha_percentage');
            $table->double('he_percentage');
            $table->double('sf_percentage');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('free_consultations');
    }
}
