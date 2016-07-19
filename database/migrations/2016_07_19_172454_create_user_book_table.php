<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_book", function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer("user_id");
            $table->integer("book_id");
            $table->foreign('user_id')
              ->references('id')->on('users');
            $table->foreign('book_id')
              ->references('id')->on('book');
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
        Schema::drop("user_book");
    }
}
