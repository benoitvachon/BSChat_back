<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function(Blueprint $table) {
		$table->increments('id');
                $table->timestamp('dateCreation');
		$table->string('nom', 100);
                $table->integer('idAdmin')->unsigned();
                $table->foreign('idAdmin')->references('id')->on('users');
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topics');
    }
}
