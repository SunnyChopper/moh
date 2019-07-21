<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('book_1', 256);
            $table->string('book_2', 256);
            $table->string('book_3', 256);
            $table->string('book_4', 256);
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('book_polls');
    }
}
