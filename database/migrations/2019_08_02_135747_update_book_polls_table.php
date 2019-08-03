<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBookPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_polls', function(Blueprint $table) {
            $table->dropColumn('book_1');
            $table->string('book_1_title', 256);
            $table->string('book_1_image_url', 512)->nullable();
            $table->text('book_1_description')->nullable();
            $table->string('book_1_amazon_url', 512)->nullable();
            $table->dropColumn('book_2');
            $table->string('book_2_title', 256);
            $table->string('book_2_image_url', 512)->nullable();
            $table->text('book_2_description')->nullable();
            $table->string('book_2_amazon_url', 512)->nullable();
            $table->dropColumn('book_3');
            $table->string('book_3_title', 256);
            $table->string('book_3_image_url', 512)->nullable();
            $table->text('book_3_description')->nullable();
            $table->string('book_3_amazon_url', 512)->nullable();
            $table->dropColumn('book_4');
            $table->string('book_4_title', 256);
            $table->string('book_4_image_url', 512)->nullable();
            $table->text('book_4_description')->nullable();
            $table->string('book_4_amazon_url', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_polls', function(Blueprint $table) {
            $table->string('book_1', 256);
            $table->dropColumn('book_1_title');
            $table->dropColumn('book_1_image_url');
            $table->dropColumn('book_1_description');
            $table->dropColumn('book_1_amazon_url');
            $table->string('book_2', 256);
            $table->dropColumn('book_2_title');
            $table->dropColumn('book_2_image_url');
            $table->dropColumn('book_2_description');
            $table->dropColumn('book_2_amazon_url');
            $table->string('book_3', 256);
            $table->dropColumn('book_3_title');
            $table->dropColumn('book_3_image_url');
            $table->dropColumn('book_3_description');
            $table->dropColumn('book_3_amazon_url');
            $table->string('book_4', 256);
            $table->dropColumn('book_4_title');
            $table->dropColumn('book_4_image_url');
            $table->dropColumn('book_4_description');
            $table->dropColumn('book_4_amazon_url');
        });
    }
}
