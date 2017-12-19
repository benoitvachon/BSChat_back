<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsertopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topicuser', function(Blueprint $table) {
            $table->integer('idTopic')->unsigned();
            $table->integer('idUser')->unsigned();
            $table->foreign('idTopic')->references('id')->on('topics');
            $table->foreign('idUser')->references('id')->on('users');
            $table->index(['idTopic', 'idUser']);
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topicuser');
    }
}
