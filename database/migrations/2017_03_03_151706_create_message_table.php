<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /*g
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function(Blueprint $table) {
		        $table->increments('id');
                $table->timestamp('dateCreation')->default(DB::raw('CURRENT_TIMESTAMP'));
		        $table->text('text', 100);
                $table->integer('idAuthor')->unsigned();
                $table->foreign('idAuthor')->references('id')->on('users');
                $table->integer('idTopic')->unsigned();
                $table->foreign('idTopic')->references('id')->on('topics');
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
