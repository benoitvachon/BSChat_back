<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsercontactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usercontact', function(Blueprint $table) {
            $table->increments("id");
            $table->integer("user1")->unsigned();
            $table->integer("user2")->unsigned();
            $table->integer("idTopic")->unsigned();
            $table->boolean("valid")->default(false);
            $table->foreign("user1")->references('id')->on('users');
            $table->foreign("user2")->references('id')->on('users');
            $table->foreign("idTopic")->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usercontact');
    }
}
