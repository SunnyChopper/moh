<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookClubBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_club_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 128);
            $table->text('description');
            $table->string('category', 128);
            $table->string('cover_url', 256);
            $table->string('amazon_url', 512)->default();
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
        Schema::dropIfExists('book_club_books');
    }
}
